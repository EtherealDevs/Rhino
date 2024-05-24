<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductItem;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(){
        $productItem = ProductItem::first();
        return view('cart.index', ['productItem' => $productItem]);
    }
    public function addToCart(Request $request)
    {
        $item = json_decode($request->item);
        $product = Product::where('id', $item->product_id)->first();
        $cart = Cart::add($item->id, $product->name, 3, $item->original_price, 0, ['product_id' => $product->id]);
        dd($cart);
    }
}
