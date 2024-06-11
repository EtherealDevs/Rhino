<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestController;
use App\Models\ProductItem;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $productItem = ProductItem::first();
    return view('home.index', ['productItem' => $productItem]);
});

Route::get('/contact', function () {
    return view('contact.index');
});

Route::get('/about', function () {
    return view('about.index');
});

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}/{productItem}', [ProductController::class, 'show'])->name('products.show');
Route::post('products/{product}/{productItem}', [ProductController::class, 'addToCart'])->name('products.addToCart');

Route::get('/test', [TestController::class, 'index'])->name('test');


Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart', [CartController::class, 'addToCart'])->name('cart.addItem');
Route::delete('/cart/{item}', [CartController::class, 'removeFromCart'])->name('cart.removeItem');

Route::get('/products/show', function () {
    return view('products.show');
});

/* Rutas de ADMIN */
// Route::get('/admin', function () {
//     return view('admin.index');
// });

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/', function () {
//         return view('home.index');
//     })->name('dashboard');
// });
