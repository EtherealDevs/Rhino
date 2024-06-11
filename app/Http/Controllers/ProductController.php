<?php

namespace App\Http\Controllers;

use App\Http\Cart\CartManager;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\Category;
use Illuminate\Http\Request;

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
        CartManager::addItem($productItem, $request->amount);
        return redirect()->route('cart');
    }
}
