<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Tentukan apakah input adalah email atau username
        $login_type = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Cek apakah user ada di database
        $user = \App\Models\User::where($login_type, $request->login)->first();

        if ($user && $user->current_session_id) {
            // 🔎 Cek apakah session lama masih aktif di tabel sessions
            $isStillActive = DB::table('sessions')
                ->where('id', $user->current_session_id)
                ->exists();

            if ($isStillActive) {
                // 🚫 Tolak login baru, user masih aktif di tempat lain
                return back()->withErrors([
                    'login' => 'Akun ini sedang digunakan di perangkat lain. Silakan logout dari sana terlebih dahulu.',
                ]);
            }
        }

        // Jika tidak aktif atau belum pernah login, lanjutkan login normal
        if (Auth::attempt([$login_type => $request->login, 'password' => $request->password], $request->boolean('remember'))) {
            $request->session()->regenerate();

            /** @var \App\Models\User $user */
            $user = Auth::user();
            $user->current_session_id = Session::getId();
            $user->save();

            return redirect()->intended('/dashboard');
        }

        // Jika password salah
        return back()->withErrors([
            'login' => __('The provided credentials do not match our records.'),
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $userId = Auth::id();
        if ($userId) {
            User::where('id', $userId)->update(['current_session_id' => null]);
        }
        // Logout user dari guard
        Auth::guard('web')->logout();

        // Hapus session dari sisi server & browser
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
