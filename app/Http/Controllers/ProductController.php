<?php

namespace App\Http\Controllers;

use App\Http\Cart\CartManager;
use App\Models\Cart;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\Category;
use App\Models\User;
use App\Notifications\OrderNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.index');
    }
    public function show(Product $product, $id)
    {
        $item = ProductItem::with(['product' => ['items' => ['color'], 'category'], 'sizes', 'images'])->where('id', $id)->first();
        $colors = $item->colors();
        return view('products.show', compact('item', 'colors'));
    }
    public function addToCart(Request $request, Product $product, ProductItem $productItem)
    {
        $request->validate([
            'amount' => 'required',
            'size' => 'required'
        ]);
            CartManager::addItem($productItem, $request->amount, $request->size);

        //Check if user logged in. If true persist the Cart to Database
        if (Auth::check()) {
            $user = User::where('id', Auth::user()->id)->first();
            CartManager::storeOrUpdateInDatabase($user);
            $cart = Cart::where('user_id',$user->id)->first();
        }
        
        if (session('cartError')) {
            return redirect()->route('cart')->with('failure', session('cartError'));
        }
        return redirect()->route('cart')->with('success', 'true');
    }
}
