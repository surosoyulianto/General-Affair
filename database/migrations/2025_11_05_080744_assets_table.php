<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('asset_number')->unique();
            $table->string('asset_name')->nullable();
            $table->string('branch')->nullable();
            $table->string('department')->nullable();
            $table->string('type_asset')->nullable();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('specification')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('ram_capacity')->nullable();
            $table->string('storage_type')->nullable();
            $table->string('storage_volume')->nullable();
            $table->string('os_edition')->nullable();
            $table->date('os_installed')->nullable();
            $table->date('purchase_date')->nullable();
            $table->string('purchase_value')->nullable();
            $table->string('location')->nullable();
            $table->string('status')->default('active');
            $table->text('description')->nullable();

            // relasi ke user yang memiliki/ditugaskan
            $table->unsignedBigInteger('owner')->nullable();
            $table->foreign('owner')->references('id')->on('users')->onDelete('set null');

            // user_id: pencatat data (creator)
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
