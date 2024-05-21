<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/',function(){
    return view('admin.index');
});
Route::resource('category',CategoryController::class)->names('admin.categories');
Route::get('/products',function(){
    return view('admin.products.index');
});

Route::get('/orders',function(){
    return view('admin.orders.index');
});

Route::get('/sales',function(){
    return view('admin.sales.index');
});

Route::get('/promos',function(){
    return view('admin.promo.index');
});

Route::get('/stock', function () {
    return view('admin.stock.index');
});
