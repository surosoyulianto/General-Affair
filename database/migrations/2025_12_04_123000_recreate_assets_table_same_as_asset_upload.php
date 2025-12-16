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
        // Drop table assets dengan CASCADE untuk menghapus constraints
        \DB::statement('DROP TABLE IF EXISTS assets CASCADE');

        // Buat table assets baru dengan struktur sama persis dengan asset_upload
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('asset_no')->nullable();
            $table->text('description')->nullable();
            $table->string('dept')->nullable();
            $table->date('acquisition_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('voucher_aqc')->nullable();
            $table->decimal('base_price', 15, 2)->nullable();
            $table->decimal('accumulation_last_year', 15, 2)->nullable();
            $table->decimal('ending_book_value_last_year', 15, 2)->nullable();
            $table->decimal('dep_rate', 5, 2)->nullable();
            $table->decimal('depreciation_yearly', 15, 2)->nullable();
            $table->decimal('book_value_last_month', 15, 2)->nullable();
            $table->decimal('depreciation_accum_depr', 15, 2)->nullable();
            $table->decimal('depreciation_book_value', 15, 2)->nullable();
            
            // user_id untuk tracking creator
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
        // Restore table assets lama (tapi struktur tidak akan sama persis)
        Schema::dropIfExists('assets');

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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
        });
    }
};
