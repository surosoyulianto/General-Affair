<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\AssetUploadController;
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


    // Endpoint AJAX detail asset by ID
    Route::get('/asset/detail-by-id', [AssetController::class, 'detailById']);

    // Copy assets from asset_upload table
    Route::post('/assets/copy-from-upload', [AssetController::class, 'copyFromUpload'])->name('assets.copy-from-upload');

    // Asset Upload Routes
    Route::get('/asset-uploads', [AssetUploadController::class, 'index'])->name('asset_uploads.index');
    Route::post('/asset-uploads', [AssetUploadController::class, 'store'])->name('asset_uploads.store');

    // Asset Transfer
    Route::resource('asset_transfers', AssetTransferController::class);
});
