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

        $login_type = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Cek user
        $user = User::where($login_type, $request->login)->first();

        // 3️⃣ Hapus session yang sudah expired
        DB::table('sessions')
            ->where('last_activity', '<', now()->subMinutes(config('session.lifetime'))->timestamp)
            ->delete();

        // 4️⃣ Cek session lama masih aktif?
        if ($user && $user->current_session_id) {

            $isStillActive = DB::table('sessions')
                ->where('id', $user->current_session_id)
                ->exists();

            if ($isStillActive) {
                return back()->withErrors([
                    'login' => 'Akun ini sedang digunakan di perangkat lain. Silakan logout dari sana terlebih dahulu.',
                ]);
            }
        }

        // 5️⃣ Login normal
        if (Auth::attempt([$login_type => $request->login, 'password' => $request->password], $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();
            $user->current_session_id = Session::getId();
            $user->save();

            return redirect()->intended('/dashboard');
        }

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

        Auth::guard('web')->logout();

        // Use the global helper in case $request is not available in some contexts
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/login');
    }

}
