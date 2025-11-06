<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ClearExpiredSessions extends Command
{
    protected $signature = 'sessions:clear-expired';
    protected $description = 'Hapus session yang sudah expired dan reset current_session_id user';

    public function handle()
    {
        $lifetime = config('session.lifetime');
        $expired = Carbon::now()->subMinutes($lifetime);

        // Ambil sesi yang sudah expired
        $expiredSessions = DB::table('sessions')
            ->where('last_activity', '<', $expired->timestamp)
            ->get();

        foreach ($expiredSessions as $session) {
            // Reset current_session_id user (jika kamu simpan di tabel users)
            DB::table('users')
                ->where('current_session_id', $session->id)
                ->update(['current_session_id' => null]);
        }

        // Hapus session expired dari database
        DB::table('sessions')
            ->where('last_activity', '<', $expired->timestamp)
            ->delete();

        $this->info('Expired sessions cleared and user current_session_id reset.');
    }
}
