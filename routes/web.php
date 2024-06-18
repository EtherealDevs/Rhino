<?php

use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\FirebaseController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Combo;
use App\Models\ProductItem;
use App\Models\Sale;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

Route::get('/', function () {
    $productItem = ProductItem::first();
    $combos = Combo::all();
    $sales= Sale::all();
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $now = Carbon::now('America/Argentina/Buenos_Aires')->translatedFormat('Y-m-d');
    foreach ($sales as $sale) {
        if ($sale->end_date == $now) {
            SaleController::destroy($sale);
        }
    }
    return view('home.index', compact('productItem','sales','combos'));
});

Route::get('/firebase', [FirebaseController::class, 'index']);


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



Route::get('/auth/redirect', [AuthController::class, 'redirect'])->name('auth.redirect');


Route::get('/auth/callback',[AuthController::class, 'callback'])->name('auth.callback');

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
