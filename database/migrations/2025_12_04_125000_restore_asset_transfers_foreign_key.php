<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Restore foreign key constraint dengan struktur assets yang baru
        Schema::table('asset_transfers', function (Blueprint $table) {
            $table->foreign('asset_id')->references('id')->on('assets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop foreign key constraint
        Schema::table('asset_transfers', function (Blueprint $table) {
            $table->dropForeign(['asset_id']);
        });
    }
};
