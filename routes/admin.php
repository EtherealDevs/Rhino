<?php

use Illuminate\Support\Facades\Route;

Route::get('/',function(){
    return view('admin.index');
});

Route::get('/orders',function(){
    return view('admin.orders.index');
});