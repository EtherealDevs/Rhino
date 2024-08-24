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
use App\Http\Controllers\Admin\ProductItemController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MyStoreController;
use Illuminate\Support\Facades\Route;


Route::get('/', [AdminController::class, 'index'])
    ->name('admin.home')
    ->middleware('can:admin.home');

Route::resource('categories', CategoryController::class)
    ->names('admin.categories')
    ->middleware(['can:admin.categories.index', 'can:admin.categories.show', 'can:admin.categories.edit', 'can:admin.categories.create']);

Route::resource('notifications', NotificationController::class)
    ->names('admin.notifications')
    ->middleware(['can:admin.notifications.index', 'can:admin.notifications.show', 'can:admin.notifications.edit', 'can:admin.notifications.create']);

Route::resource('products', ProductController::class)
    ->names('admin.products')
    ->middleware(['can:admin.products.index', 'can:admin.products.show', 'can:admin.products.edit', 'can:admin.products.create']);

Route::resource('promo', PromoController::class)
    ->names('admin.promos')
    ->middleware(['can:admin.promos.index', 'can:admin.promos.show', 'can:admin.promos.edit', 'can:admin.promos.create']);

Route::resource('orders', OrderController::class)
    ->names('admin.orders')
    ->middleware(['can:admin.orders.index', 'can:admin.orders.show', 'can:admin.orders.edit', 'can:admin.orders.create']);
Route::put('/admin/orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');

Route::resource('sales', SaleController::class)
    ->names('admin.sales')
    ->middleware(['can:admin.sales.index', 'can:admin.sales.show', 'can:admin.sales.edit', 'can:admin.sales.create']);

Route::resource('stock', StockController::class)
    ->names('admin.stock')
    ->middleware(['can:admin.stock.index', 'can:admin.stock.show', 'can:admin.stock.edit', 'can:admin.stock.create']);

Route::resource('combos', ComboController::class)
    ->names('admin.combos')
    ->middleware(['can:admin.combos.index', 'can:admin.combos.show', 'can:admin.combos.edit', 'can:admin.combos.create']);

Route::resource('colors', ColorController::class)
    ->names('admin.colors')
    ->middleware(['can:admin.colors.index', 'can:admin.colors.show', 'can:admin.colors.edit', 'can:admin.colors.create']);

Route::resource('brands', BrandController::class)
    ->names('admin.brands')
    ->middleware(['can:admin.brands.index', 'can:admin.brands.show', 'can:admin.brands.edit', 'can:admin.brands.create']);

Route::resource('sizes', SizeController::class)
    ->names('admin.sizes')
    ->middleware(['can:admin.sizes.index', 'can:admin.sizes.show', 'can:admin.sizes.edit', 'can:admin.sizes.create']);

Route::resource('users', UserController::class)
    ->names('admin.users')
    ->middleware(['can:admin.users.index', 'can:admin.users.show', 'can:admin.users.edit', 'can:admin.users.create']);

Route::resource('mystore', MyStoreController::class)
    ->names('admin.mystore')
    ->middleware('can:admin.mystore.index');

Route::get('/ventas', [OrderController::class, 'ventas'])
    ->name('admin.ventas.index')
    ->middleware(['can:admin.ventas.index', 'can:admin.ventas.show', 'can:admin.ventas.edit', 'can:admin.ventas.create']);

Route::resource('productitems', ProductItemController::class)
    ->names('admin.productitems')
    ->middleware(['can:admin.productitem.index', 'can:admin.productitem.show', 'can:admin.productitem.edit', 'can:admin.productitem.create']);
