<?php

use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\UserDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.home.index');
});

// 'prefix' => 'user', 'as' => 'user.',
Route::group([ 'middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/orders', [UserDashboardController::class, 'orders'])->name('orders');
    Route::get('/track-order', [UserDashboardController::class, 'trackOrder'])->name('track-order');
    Route::get('/address', [UserDashboardController::class, 'address'])->name('address');
    Route::get('/wishlist', [UserDashboardController::class, 'wishlist'])->name('wishlist');
    Route::get('/account', [UserDashboardController::class, 'account'])->name('account');
});

Route::get('/profile', [ProfileController::class,'index'])->name('profile');
Route::post('/profile', [ProfileController::class,'profileUpdate'])->name('profile.update');


require __DIR__ . '/auth.php';
