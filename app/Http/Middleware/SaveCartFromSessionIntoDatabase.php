<?php

namespace App\Http\Middleware;

use App\Http\Cart\CartManager;
use App\Models\Cart;
use App\Models\User;
use Closure;
use Error;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SaveCartFromSessionIntoDatabase
{
    protected $cartContents;

    public function __construct()
    {
        $this->cartContents = CartManager::getCartContents();
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $user = User::where('id', auth()->user()->id)->first();
            $dbCart = Cart::where('user_id', $user->id)->first();

            if (session()->exists('cart')) {
                $sessionCart = session('cart');
            } else { $sessionCart = null; }

            if ($sessionCart != null) {
                if ($dbCart != null) {
                    CartManager::compareAndSaveCarts($dbCart, $sessionCart, $user);
                } else {
                    CartManager::storeOrUpdateInDatabase($user, $sessionCart);
                }
            }
        
        }
        return $next($request);
    }
}