<?php

use App\Http\Controllers\AssetController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('assets_it', AssetController::class)->names([
        'index'   => 'assets_it.index',
        'create'  => 'assets_it.create',
        'store'   => 'assets_it.store',
        'show'    => 'assets_it.show',
        'edit'    => 'assets_it.edit',
        'update'  => 'assets_it.update',
        'destroy' => 'assets_it.destroy',
    ]);
});
