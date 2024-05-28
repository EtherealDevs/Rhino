<?php

namespace App\Http\Controllers;

use App\Http\Cart\Cart;
use App\Models\Cart as ModelsCart;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(){
        $productItems = ProductItem::all();
        $cartItems = Cart::getCartContents();
        return view('cart.index', ['productItems' => $productItems, 'cartItems' => $cartItems]);
    }
    public function addToCart(Request $request)
    {
        $item1 = json_decode($request->item);
        $item = ProductItem::where('id', $item1->id)->first();

        //Add Item to Cart in session.
        Cart::addItem($item);
        //Check if user logged in. If true persist the Cart to Database
        if (Auth::check()) {
            $user = User::where('id', Auth::user()->id)->first();
            Cart::storeOrUpdateInDatabase($user);
        }
        return redirect()->route('cart')->with('success');
    }
    public function removeFromCart(Request $request, ProductItem $item)
    {
        // $item = ProductItem::where('id', json_decode($request->item)->id)->first();
        Cart::removeItem($item);
        return redirect()->route('cart')->with('success');
    }
}
