<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product_item=ProductItem::create([
            'product_id' => $request->product_id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
            'original_price'=>$request->original_price,
            'sale_price' => $request->sale_price,
            'stock' => $request->stock,
        ]);
        if($request->file('image')){
            $url = Storage::put('products', $request->file('image'));
            $product_item->image()->create([
                'url' => $url
            ]);
        }
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductItem $product_item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductItem $product_item)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductItem $product_item)
    {
        $product_item->update([
            'product_id' => $request->product_id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
            'original_price'=>$request->original_price,
            'sale_price' => $request->sale_price,
            'stock' => $request->stock,
        ]);
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductItem $product_item)
    {
        $product_item->delete();
        return redirect()->route('admin.products.index');
    }
}
