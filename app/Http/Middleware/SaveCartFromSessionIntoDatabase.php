<?php

namespace App\Http\Middleware;

use App\Http\Cart\CartManager;
use App\Http\Cart\SessionCartManager;
use App\Models\Cart;
use App\Models\User;
use Closure;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Services\CartService;

class SaveCartFromSessionIntoDatabase
{
    protected $cartService;
    protected $user;

    public function __construct()
    {
        $user = Auth::user();
        $this->user = $user;
        $this->cartService = new CartService();
    }

    public function handle(Request $request, Closure $next): Response
    {
        // Check if a session cart exists before attempting to transfer it to the database
        $sessionCartExists = SessionCartManager::checkIfCartExists();
        if ($sessionCartExists) {
            $this->cartService->transferCart();
        }
        return $next($request);
    }
}