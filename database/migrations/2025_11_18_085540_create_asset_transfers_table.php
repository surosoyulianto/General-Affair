<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('asset_transfers', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('asset_id');
            $table->unsignedBigInteger('from_user_id')->nullable();
            $table->unsignedBigInteger('to_user_id')->nullable();

            // (Opsional) jika branch/department ikut berubah saat transfer
            $table->unsignedBigInteger('from_branch_id')->nullable();
            $table->unsignedBigInteger('to_branch_id')->nullable();

            $table->unsignedBigInteger('from_department_id')->nullable();
            $table->unsignedBigInteger('to_department_id')->nullable();

            $table->date('transfer_date')->default(now());
            $table->text('reason')->nullable();

            $table->timestamps();

            // Foreign keys
            $table->foreign('asset_id')->references('id')->on('assets')->onDelete('cascade');
            $table->foreign('from_user_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('to_user_id')->references('id')->on('users')->nullOnDelete();

            $table->foreign('from_branch_id')->references('id')->on('branches')->nullOnDelete();
            $table->foreign('to_branch_id')->references('id')->on('branches')->nullOnDelete();

            $table->foreign('from_department_id')->references('id')->on('departments')->nullOnDelete();
            $table->foreign('to_department_id')->references('id')->on('departments')->nullOnDelete();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_transfers');
    }
};
