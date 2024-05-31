<?php

namespace App\Http\Controllers;

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
        $item = ProductItem::with(['product'])->where('id', $id)->first();
        return view('products.show', compact('item'));
    }
}
