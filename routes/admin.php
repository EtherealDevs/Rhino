<?php

use Illuminate\Support\Facades\Route;

Route::get('/',function(){
    return view('admin.index');
});

Route::get('/products',function(){
    return view('admin.products.index');
});

Route::get('/orders',function(){
    return view('admin.orders.index');
});

Route::get('/sales',function(){
    return view('admin.sales.index');
});