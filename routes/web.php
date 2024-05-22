<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
});

Route::get('/contact', function () {
    return view('contact.index');
});

Route::get('/about', function () {
    return view('about.index');
});

Route::get('/products', function () {
    return view('products.index');
});

Route::get('/cart', function () {
    return view('cart.index');
});

Route::get('/productshow', function () {
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
