<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\ProductImage;
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
        $request->validate([
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // Otros campos...
        ]);

        $product_item = ProductItem::create([
            'product_id' => $request->product_id,
            'color_id' => $request->color_id,
            'original_price' => $request->original_price,
            'sale_price' => $request->sale_price,
        ]);

        $product_item->sizes()->attach($request->size_id, ['stock' => $request->stock]);

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
        $productSize = DB::table('products_sizes')->where('id', $product)->first();
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
        // Validar la solicitud
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'original_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'size_id' => 'required|exists:sizes,id',
            'stock' => 'required|integer|min:0',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Asegúrate de que esto esté aquí
        ]);


        // Encontrar el ProductItem por su ID
        $productItem = ProductItem::findOrFail($productItemId);

        // Actualizar el ProductItem
        $productItem->update([
            'product_id' => $request->product_id,
            'original_price' => $request->original_price,
            'sale_price' => $request->sale_price,
        ]);

        // Actualizar el stock en la tabla pivote
        $productItem->sizes()->updateExistingPivot($request->size_id, ['stock' => $request->stock]);

        // Manejar la carga de nuevas imágenes
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
        // Obtener el tamaño del producto (product_size) a eliminar
        $productSize = DB::table('products_sizes')->where('id', $productSizeId)->first();

        // Verificar que se encontró el product_size
        if (!$productSize) {
            return redirect()->route('admin.products.index')->with('error', 'Tamaño del producto no encontrado.');
        }

        // Obtener el item del producto asociado
        $productItem = ProductItem::with('sizes')->find($productSize->product_item_id);

        if (!$productItem) {
            return redirect()->route('admin.products.index')->with('error', 'Item del producto no encontrado.');
        }

        // Eliminar la relación en la tabla pivote (products_sizes)
        $productItem->sizes()->detach($productSize->size_id); // Utiliza detach para eliminar la relación

        // Opcionalmente, si deseas eliminar el producto si no hay más tamaños asociados
        if ($productItem->sizes()->count() === 0) {
            $productItem->delete(); // Elimina el item del producto si no hay más tamaños
        }

        return redirect()->route('admin.products.index')->with('success', 'Tamaño del producto eliminado correctamente.');
    }

    public function restore($id)
    {
        $productItem = ProductItem::onlyTrashed()->findOrFail($id);
        $productItem->restore();

        return redirect()->route('admin.products.index')->with('success', 'Producto recuperado con éxito.');
    }

    public function forceDelete($id)
    {
        $productItem = ProductItem::onlyTrashed()->findOrFail($id);
        $productItem->forceDelete();

        return redirect()->route('admin.products.index')->with('success', 'Producto eliminado definitivamente.');
    }
}
