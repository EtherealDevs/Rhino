<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('welcome');
    })->name('dashboard');
});
