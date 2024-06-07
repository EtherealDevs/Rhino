<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\ProductItem;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.index');
    }
    public function show($id)
    {
        $item = ProductItem::with(['product' => ['items' => ['color'], 'category'], 'sizes', 'images'])->where('id', $id)->first();
        $colors = $item->colors();
        return view('products.show', compact('item', 'colors'));
    }
}
