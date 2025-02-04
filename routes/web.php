<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/search', [DashboardController::class, 'search'])->name('products.search');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cart Routes
    Route::prefix('cart')->group(function () {
        Route::post('/add/{encryptedProductId}', [CartController::class, 'addToCart'])->name('cart_add');
        Route::get('/', [CartController::class, 'viewCart'])->name('cart_view');
        Route::post('/order', [CartController::class, 'placeOrder'])->name('order.place');
        Route::get('/account/orders', [CartController::class, 'viewOrders'])->name('account_orders');
        Route::get('/product', [CartController::class, 'showOrderProduct'])->name('product_show');
    });
});

require __DIR__.'/auth.php';
