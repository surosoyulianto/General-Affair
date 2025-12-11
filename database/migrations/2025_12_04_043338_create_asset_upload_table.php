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
        Schema::create('asset_upload', function (Blueprint $table) {
            $table->id();
            $table->string('asset_no')->nullable(); // No. Asset, No
            $table->text('description')->nullable(); // Description
            $table->string('dept')->nullable(); // DEPT
            $table->date('acquisition_date')->nullable(); // Acquisition Date
            $table->date('end_date')->nullable(); // End Date
            $table->string('voucher_aqc')->nullable(); // Voucher Aqc.
            $table->decimal('base_price', 15, 2)->nullable(); // Base Price
            $table->decimal('accumulation_last_year', 15, 2)->nullable(); // Accumulation Last Year
            $table->decimal('ending_book_value_last_year', 15, 2)->nullable(); // Ending Book Value Last Year
            $table->decimal('dep_rate', 5, 2)->nullable(); // Dep Rate
            $table->decimal('depreciation_yearly', 15, 2)->nullable(); // Depreciation Yearly
            $table->decimal('book_value_last_month', 15, 2)->nullable(); // Book Value Last Month
            $table->decimal('depreciation_accum_depr', 15, 2)->nullable(); // Depreciation Accum Depr
            $table->decimal('depreciation_book_value', 15, 2)->nullable(); // Depreciation Book Value
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_upload');
    }
};
