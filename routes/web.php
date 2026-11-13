<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Products
Route::get('/collection', [ProductController::class, 'index'])->name('products.index');
Route::get('/fragrance/{slug}', [ProductController::class, 'show'])->name('products.show');

// Shopping Cart
Route::get('/bag', [CartController::class, 'index'])->name('cart.index');
Route::post('/bag/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/bag/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/bag/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/bag/mini', [CartController::class, 'getMiniCart'])->name('cart.mini');

// Checkout Flow
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

// Payment & Orders
Route::get('/payment/{order_number}', [PaymentController::class, 'show'])->name('payment.show');
Route::post('/payment/{order_number}/simulate', [PaymentController::class, 'simulatePay'])->name('payment.simulate');
Route::post('/payment/{order_number}/proof', [PaymentController::class, 'uploadProof'])->name('payment.proof');
Route::get('/order/{order_number}/invoice', [PaymentController::class, 'invoice'])->name('order.invoice');

// Editorial / Brand Pages
Route::view('/atelier', 'pages.atelier')->name('atelier');
Route::view('/contact', 'pages.contact')->name('contact');

// Admin Panel & Content Management
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [\App\Http\Controllers\Admin\AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');

    Route::middleware('admin')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

        // Products Catalog Management
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class)->except(['show']);

        // Olfactory Categories Management
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class)->except(['show', 'create', 'edit']);

        // Orders & Transactions Management
        Route::get('/orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [\App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');
        Route::patch('/orders/{order}/status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    });
});
