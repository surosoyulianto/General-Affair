<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\AssetTransferController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {

    // Asset Resource
    Route::resource('assets', AssetController::class)->names([
        'index' => 'assets.index',
        'create' => 'assets.create',
        'store' => 'assets.store',
        'show' => 'assets.show',
        'edit' => 'assets.edit',
        'update' => 'assets.update',
        'destroy' => 'assets.destroy',
    ]);

    // Endpoint AJAX — pakai query parameter agar nomor asset mengandung "/"
    Route::get('/asset/detail-by-number', [AssetController::class, 'detailByNumber'])
        ->name('asset.detail-by-number');

    // Asset Transfer
    Route::resource('asset_transfers', AssetTransferController::class);
});
