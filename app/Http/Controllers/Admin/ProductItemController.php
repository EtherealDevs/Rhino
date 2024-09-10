<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\ProductsSize;
use App\Models\Size;
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
        $product_item = ProductItem::create([
            'product_id' => $request->product_id,
            'color_id' => $request->color_id,
            'original_price' => $request->original_price,
            'sale_price' => $request->sale_price,
        ]);

        ProductsSize::create([
            'product_item_id' => $product_item->id,
            'size_id' => $request->size_id,
            'stock' => $request->stock,
        ]);

        // Verifica si se han subido imágenes
        if ($request->hasFile('images')) {
            // Itera sobre cada imagen y guárdala
            foreach ($request->file('images') as $image) {
                $url = Storage::put('images/product', $image);
                $product_item->images()->create([
                    'url' => $url,
                ]);
            }
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
    public function edit( $product) {
        $productSize = ProductsSize::where('id',$product)->first();
        $productItem = ProductItem::where('id',$productSize->product_item_id)->first();
        $stock= $productSize->stock;
        $size = Size::where('id',$productSize->size_id)->first();
        $colors= Color::all();
        $products= Product::all();
        $brands=Brand::all();
        $categories=Category::all();
        return view('admin.products.edit', compact('colors', 'products','brands','size','categories','productItem','stock'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductItem $productItem)
    {

        $productItem->first()->update([
            'product_id' => $request->product_id,
            'original_price' => $request->original_price,
            'sale_price' => $request->sale_price,
        ]);
        $productItem->first()->sizes()->where('size_id', $request->size_id)->update([
            'stock' => $request->stock,
            ]);

        if ($request->file){
            $url = Storage::put('images/product', $request->file('image'));
            $productItem->images()->create( ['url' => $url]);
        }
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductItem $product_item)
    {
        Storage::delete($product_item->images->first()->url);
        $product_item->images()->delete();
        $product_item->delete();
        return redirect()->route('admin.products.index');
    }
}
