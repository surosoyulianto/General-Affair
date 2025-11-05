<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SingleLogin
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $currentSessionId = Session::getId();

            // Jika user punya session lama dan berbeda dengan session sekarang
            if ($user->current_session_id && $user->current_session_id !== $currentSessionId) {
                Auth::logout();

                // Hapus session sekarang biar aman
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login')->withErrors([
                    'login' => 'Akun ini sedang digunakan di perangkat lain.',
                ]);
            }
        }

        return $next($request);
    }
}
