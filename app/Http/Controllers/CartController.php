<?php

namespace App\Http\Controllers;

use App\Http\Cart\CartManager;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(){
        $productItems = ProductItem::all();
        if (Auth::check()) {
            $cartModel = Cart::where('user_id', Auth::user()->id)->first();
            $cartItems = CartManager::getCartContents($cartModel);
        } else{
            $cartItems = CartManager::getCartContents();
        }
        return view('cart.index', ['productItems' => $productItems, 'cartItems' => $cartItems]);
    }
    public function addToCart(Request $request)
    {
        $decodedItem = json_decode($request->item);
        $item = ProductItem::where('id', $decodedItem->id)->first();

        //Add Item to Cart in session.
        CartManager::addItem($item);
        //Check if user logged in. If true persist the Cart to Database
        if (Auth::check()) {
            $user = User::where('id', Auth::user()->id)->first();
            CartManager::storeOrUpdateInDatabase($user);
        }
        return redirect()->route('cart')->with('success');
    }
    public function removeFromCart(Request $request, ProductItem $item)
    {
        // $item = ProductItem::where('id', json_decode($request->item)->id)->first();
        CartManager::removeItem($item);
        return redirect()->route('cart')->with('success');
    }
}
