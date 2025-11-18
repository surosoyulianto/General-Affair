<?php

use App\Http\Controllers\AssetTransferController;
use Illuminate\Support\Facades\Route;

Route::prefix('asset-transfers')->name('asset_transfers.')->group(function () {
    Route::get('/', [AssetTransferController::class, 'index'])->name('index');
    Route::get('/create', [AssetTransferController::class, 'create'])->name('create');
    Route::post('/', [AssetTransferController::class, 'store'])->name('store');
    Route::get('/{id}', [AssetTransferController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [AssetTransferController::class, 'edit'])->name('edit');
    Route::put('/{id}', [AssetTransferController::class, 'update'])->name('update');
    Route::delete('/{id}', [AssetTransferController::class, 'destroy'])->name('destroy');
});
