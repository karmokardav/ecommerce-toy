<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\ProductShowController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;

Route::get('/test-cart', function () {
    dd(session('cart'));
});
Route::get('/', [ProductShowController::class, 'home'])->name('home');
Route::get('/products', [ProductShowController::class, 'products'])->name('frontend.products');
Route::get('/product/{id}', [ProductShowController::class, 'show'])->name('product.show');

Route::post('/cart/add', [CartController::class, 'add']);
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/update', [CartController::class, 'update']);
Route::post('/cart/remove', [CartController::class, 'remove']);

Route::get('/checkout',[CheckoutController::class,'checkout'])->name('checkout');
Route::post('/place-order',[CheckoutController::class,'placeOrder'])->name('place.order');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', fn() => view('admin.dashboard'));
    Route::resource('/admin/categories', CategoryController::class)->names('categories');
    Route::resource('/admin/products', ProductController::class)->names('products');

    Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders');

    Route::get('/admin/orders/{id}', [OrderController::class, 'show'])
        ->name('admin.orders.show');

    Route::post('/admin/orders/{id}/status', [OrderController::class, 'updateStatus'])
        ->name('admin.orders.status');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
