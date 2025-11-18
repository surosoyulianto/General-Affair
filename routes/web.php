<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/partials/profile.php';
require __DIR__.'/partials/administrator/user.routes.php';
require __DIR__.'/partials/auth.php';
require __DIR__.'/partials/asset.routes.php';
require __DIR__.'/partials/asset_transfer.routes.php';
