<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\ProductShowController;

Route::get('/', [ProductShowController::class, 'home'])->name('home');
Route::get('/products', [ProductShowController::class, 'products'])->name('frontend.products');
Route::get('/product/{id}', [ProductShowController::class, 'show'])->name('product.show');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', fn() => view('admin.dashboard'));
    Route::resource('/admin/categories', CategoryController::class)->names('categories');
    Route::resource('/admin/products', ProductController::class)->names('products');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
