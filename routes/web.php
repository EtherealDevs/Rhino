<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\ComboController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\FirebaseController;
use App\Http\Controllers\WhapController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Combo;
use App\Models\ProductItem;
use App\Models\Sale;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use App\Http\Controllers\FavoriteController;
use App\Livewire\Navigation;
use App\Http\Controllers\OrderController;

use App\Livewire\ShippingCost;

Route::get('/', [HomeController::class, 'index']);

// web.php o api.php
Route::post('/calcular-envio', [ShippingCost::class, 'calcularEnvio']);

Route::middleware(['auth'])->group(function () {
    Route::post('/favorites/add/{product}', [Navigation::class, 'add'])->name('favorites.add');
    Route::post('/favorites/remove/{favorite}', [Navigation::class, 'remove'])->name('favorites.remove');
    Route::get('/favorites', Navigation::class)->name('favorites.view');
});


Route::get('/firebase', [FirebaseController::class, 'index']);


Route::get('/contact', function () {
    return view('contact.index');
});

Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');


Route::get('/eliminacion-datos', function () {
    return view('eliminacion-datos.index');
});

Route::get('/about', function () {
    return view('about.index');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/checkout/delivery', [CheckoutController::class, 'showCheckoutDeliveryPage'])->name('checkout.delivery');
    Route::get('/checkout/payment', [CheckoutController::class, 'showCheckoutPaymentPage'])->name('checkout.payment');
    Route::post('checkout/delivery', [CheckoutController::class, 'validateAddressAndSaveToDatabase'])->name('checkout.delivery.address');
    Route::post('/process_payment', [CheckoutController::class, 'processPayment'])->name('checkout.processPayment');
});

Route::get('/successfullyPaid', function () {
    return view('payments.successfullyPaid');
});

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}/{productItem}', [ProductController::class, 'show'])->name('products.show');
Route::post('products/{product}/{productItem}', [ProductController::class, 'addToCart'])->name('products.addToCart');

Route::get('/category/{category]', [ProductController::class, 'show'])->name('products.category');

Route::resource('/combos', ComboController::class)->names('combos');
// Route::get('/combos/show', [ComboController::class, 'show'])->name('combos.show');


// Ruta para mostrar todos los pedidos
Route::get('orders', [OrderController::class, 'index'])->name('orders.index');

Route::get('promos', [PromoController::class, 'index'])->name('promos.index');

// Ruta para mostrar un pedido específico
Route::get('orders/{id}', [OrderController::class, 'show'])->name('orders.show');


Route::get('/test', [TestController::class, 'index'])->name('test');

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/cart/envio', [CartController::class, 'envio'])->name('cart.envio');
Route::post('/cart', [CartController::class, 'addToCart'])->name('cart.addItem');
Route::post('/cart/{cartItemId}', [CartController::class, 'updateFromCart'])->name('cart.updateItem');
Route::post('/cartCombo', [CartController::class, 'addComboToCart'])->name('cart.addCombo');
Route::delete('/cart/{cartItemId}', [CartController::class, 'removeFromCart'])->name('cart.removeItem');
Route::delete('/cart', [CartController::class, 'dropCart'])->name('cart.dropCart');

Route::get('/products/show', function () {
    return view('products.show');
});

Route::get('/auth/redirect/facebook', [AuthController::class, 'redirectFacebook'])->name('auth.redirect.facebook');
Route::get('/auth/callback/facebook', [AuthController::class, 'callbackFacebook'])->name('auth.callback.facebook');

Route::get('/auth/redirect/google', [AuthController::class, 'redirectGoogle'])->name('auth.redirect.google');
Route::get('/auth/callback/google', [AuthController::class, 'callbackGoogle'])->name('auth.callback.google');

Route::get('/enviowa', [WhapController::class, 'envio']);

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
