<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckSessionExpiry
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $sessionId = Session::getId();
            $session = DB::table('sessions')->where('id', $sessionId)->first();

            if ($session) {
                $lifetime = config('session.lifetime') * 60; // detik
                $expired = (time() - $session->last_activity) > $lifetime;

                if ($expired) {
                    // hapus current_session_id user
                    $user = Auth::user();
                    if ($user instanceof \App\Models\User) {
                        $user->current_session_id = null;
                        $user->save();
                    }

                    // logout & hapus session
                    Auth::logout();
                    Session::flush();

                    return redirect()->route('login')
                        ->with('message', 'Session expired. Please log in again.');
                }
            }
        }

        return $next($request);
    }
}
