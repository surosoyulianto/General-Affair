<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // 🔹 Default UUID tergantung database driver
            if (DB::getDriverName() === 'pgsql') {
                $table->uuid('uuid')->unique()->default(DB::raw('gen_random_uuid()'));
            } else {
                $table->uuid('uuid')->unique()->default(DB::raw('(UUID())'));
            }

            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('status')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
