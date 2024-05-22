<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\ComboController;
use App\Http\Controllers\Admin\PromoController;
use App\Http\Controllers\Admin\NotificationController;
use App\Models\Brand;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Route;

Route::get('/',[AdminController::class,'index']);
Route::resource('category',CategoryController::class)->names('admin.categories');

Route::resource('notification',NotificationController::class)->names('admin.notifications');

Route::resource('product',ProductController::class)->names('admin.products');

Route::resource('promo',PromoController::class)->names('admin.promos');

Route::resource('orders',OrderController::class)->names('admin.orders');

Route::resource('sale',SaleController::class)->names('admin.sales');

Route::resource('promo',PromoController::class)->names('admin.promos');

Route::resource('stock',StockController::class)->names('admin.stock');

Route::resource('combo',ComboController::class)->names('admin.combos');

Route::resource('color', ColorController::class)->names('admin.colors');

Route::resource('brand', BrandController::class)->names('admin.brands');
