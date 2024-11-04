<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\ProductSize;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $brands = Brand::all();
        $categories = Category::all();
        $deletedItems = ProductSize::onlyTrashed()->get();
        $productSizes = ProductSize::with('item.product', 'size')
        ->get()
        ->groupBy('item.product.id');
        return view('admin.products.index', compact( 'deletedItems', 'productSizes', 'products', 'brands', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $colors = Color::all();
        $products = Product::all();
        $brands = Brand::all();
        $sizes = Size::all();
        $categories = Category::all();
        return view('admin.products.create', compact('colors', 'products', 'brands', 'sizes', 'categories'));
    }


    public function store(Request $request)
    {
        // Validar los campos requeridos antes de crear el producto
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug', // El slug debe ser único
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id', // Debe existir en la tabla categories
            'brand_id' => 'required|exists:brands,id', // Debe existir en la tabla brands
            'volume' => 'required|numeric|min:0',
            'weight' => 'required|numeric|min:0',
        ]);

        // Crear el producto con los datos validados
        Product::create([
            'name' => $validatedData['name'],
            'slug' => $validatedData['slug'],
            'description' => $validatedData['description'],
            'category_id' => $validatedData['category_id'],
            'brand_id' => $validatedData['brand_id'],
            'volume' => $validatedData['volume'],
            'weight' => $validatedData['weight'],
        ]);

        return redirect()->back()->with('success', 'Producto creado exitosamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($product, Size $size) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'volume' => $request->volume,
            'weight' => $request->weight
        ]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        foreach ($product->items() as $item) {
            $item->destroy();
        }
        $product->delete();
        return redirect()->back();
    }
}
