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
        Schema::create('assets_it', function (Blueprint $table) {
            $table->id();
            $table->string('asset_number')->unique();
            $table->string('name')->nullable();
            $table->string('branch')->nullable();
            $table->string('department')->nullable();
            $table->string(column: 'specification ')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('ram_capacity')->nullable();
            $table->string('type_asset')->nullable();
            $table->string('storage_type')->nullable();
            $table->string('storage_volume')->nullable();
            $table->string('os_edition')->nullable();
            $table->date('os_installed')->nullable();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->date('purchase_date')->nullable();
            $table->string('purchase_value')->nullable();
            $table->string('location')->nullable();
            $table->string('status')->default('active');
            $table->text('description')->nullable();

            // relasi opsional ke user / karyawan yang menggunakan asset
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->foreign('assigned_to')->references('id')->on('users')->nullOnDelete();

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
