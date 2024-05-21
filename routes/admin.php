<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\ComboController;
use App\Http\Controllers\Admin\PromoController;
use Illuminate\Support\Facades\Route;

Route::get('/',function(){
    return view('admin.index');
});
Route::resource('category',CategoryController::class)->names('admin.categories');

Route::resource('product',ProductController::class)->names('admin.products');

Route::resource('promo',PromoController::class)->names('admin.promos');

Route::resource('order',OrderController::class)->names('admin.orders');

Route::resource('sale',SaleController::class)->names('admin.sales');

Route::resource('promo',PromoController::class)->names('admin.promos');

Route::resource('stock',StockController::class)->names('admin.stock');

Route::resource('combo',ComboController::class)->names('admin.combos');
