<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\ProductImage;
use App\Models\Image;
use App\Models\ProductSize;
use App\Models\ProductsSize;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        dd($request);
        $request->validate([
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // Otros campos...
        ]);
        $product_item = ProductItem::where('product_id',$request->product_id)->where('color_id',$request->color_id)->first();
        if(isset($product_item)){
                $product_size=$product_item->sizes()->wherePivot('size_id',$request->size_id)->first();
                if(isset($product_size)){
                $product_stock=$product_item->sizes()->wherePivot('size_id',$request->size_id)->first()->pivot;
                $stock=$product_stock->stock+$request->stock;
                $product_item->sizes()->wherePivot('size_id',$request->size_id)->first()->pivot->update(['stock'=>$stock]);
                }else{
                    $product_item->sizes()->attach($request->size_id, ['stock' => $request->stock]);
                }
        }else{
            $product_item = ProductItem::create([
                'product_id' => $request->product_id,
                'color_id' => $request->color_id,
                'original_price' => $request->original_price,
                'sale_price' => $request->sale_price,
            ]);
            $product_item->sizes()->attach($request->size_id, ['stock' => $request->stock]);
        }


        // Verifica si se han subido imágenes
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Almacena la imagen
                $url = Storage::put('images/product', $image);
                // Crea una nueva imagen asociada al product_item
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
    public function edit($product)
    {
        $productSize = ProductSize::withTrashed()->where('id', $product)->first();
        $productItem = ProductItem::where('id', $productSize->product_item_id)->first();
        $size = Size::where('id', $productSize->size_id)->first();
        $variationModel = $productItem->getItemPivotModel($size);
        $stock = $variationModel->stock;
        $colors = Color::all();
        $products = Product::all();
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.products.edit', compact('colors', 'products', 'brands', 'size', 'categories', 'productItem', 'stock'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $productItemId)
    {
        $request->validate([
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // Otros campos...
        ]);
        dd($request);
        $productItem = ProductItem::findOrFail($productItemId);

        $productItem->update([
            'product_id' => $request->product_id,
            'original_price' => $request->original_price,
            'sale_price' => $request->sale_price,
        ]);

        $productItem->sizes()->updateExistingPivot($request->size_id, ['stock' => $request->stock]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $url = Storage::put('images/product', $image);
                $productItem->images()->create(['url' => $url]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Producto actualizado correctamente.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($productSizeId)
    {
        $variation = ProductSize::find($productSizeId);
        $variation->delete();
        // $productSize = DB::table('products_sizes')->where('id', $productSizeId)->first();

        // if (!$productSize) {
        //     return redirect()->route('admin.products.index')->with('error', 'Tamaño del producto no encontrado.');
        // }

        // $productItem = ProductItem::with('sizes')->find($productSize->product_item_id);

        // if (!$productItem) {
        //     return redirect()->route('admin.products.index')->with('error', 'Item del producto no encontrado.');
        // }

        // $productItem->sizes()->detach($productSize->size_id);

        // $productItem->delete();
        // if ($productItem->sizes()->count() === 0) {
        // }

        return redirect()->route('admin.products.index')->with('success', 'Tamaño del producto eliminado correctamente.');
    }

    public function restore($id)
    {
        $productItem = ProductSize::onlyTrashed()->findOrFail($id);
        $productItem->restore();

        return redirect()->route('admin.products.index')->with('success', 'Producto recuperado con éxito.');
    }

    public function forceDelete($id)
    {
        $productItem = ProductItem::onlyTrashed()->findOrFail($id);
        $productItem->forceDelete();

        return redirect()->route('admin.products.index')->with('success', 'Producto eliminado definitivamente.');
    }

    public function deleteImage($id)
    {
        $image = Image::findOrFail($id);
        $imageInStorage = Storage::exists($image->url);
        Storage::delete($image->url);
        $image->delete();
        dd($image, $id, $imageInStorage);

        return redirect()->back()->with('success', 'Imagen eliminada correctamente.');
    }
}

