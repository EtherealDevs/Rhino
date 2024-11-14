<?php

namespace App\Http\Controllers;

use App\Http\Cart\CartManager;
use App\Models\Cart;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\Category;
use App\Models\Size;
use App\Models\Combo;
use App\Models\ProductSize;
use App\Models\Reviews;
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

    public function api()
    {
        // Obtener todos los productos
        $products = Product::all();

        // Devolver los productos como JSON
        return response()->json($products);
    }

    public function show(Product $product, $id)
    {
        // Obtener las variedades de talla del producto
        $itemVariations = ProductSize::where('product_item_id', $id)->get();
        if ($itemVariations == null || $itemVariations->isEmpty()) {
            return abort(404);
        }
        // Calcular el promedio de estrellas
        $averageRating = $product->reviews()->avg('rating');

        // Redondear a la estrella más cercana
        $averageRating = round($averageRating * 2) / 2;

        $item = ProductItem::with(['product' => ['items' => ['color', 'sizes'], 'category'], 'sizes', 'images'])
        ->where('id', $id)
        ->first();
        // Obtener las variedades de colores del producto
        $productVariations = $item->product->items->load('sizes')->filter(function (ProductItem $variation, int $key) use($item)
        {
            foreach ($variation->sizes as $size)
            {
                if ($size->pivot->deleted_at == null && $variation->id != $item->id)
                {
                    return true;
                }
            }
        });
        $colors = $item->colors();
        $reviews = Reviews::with('user', 'product')->get();
        return view('products.show', compact('item', 'productVariations', 'colors', 'itemVariations', 'reviews', 'averageRating'));
    }

    public function filter(Request $request)
    {
        // Obtener las categorías, talles y precios seleccionados
        $selectedCategories = $request->input('categories', []);
        $selectedSizes = $request->input('sizes', []);
        $minPrice = max(1, (int) str_replace(['$', '.', ' '], '', $request->input('minprice', 1)));
        $maxPrice = max(1, (int) str_replace(['$', '.', ' '], '', $request->input('maxprice', 500000)));

        // Consultar productos basados en las categorías seleccionadas
        $productsQuery = Product::query();

        if (!empty($selectedCategories)) {
            $productsQuery->whereIn('category_id', $selectedCategories);
        }

        // Filtrar por talles a nivel de ProductItem
        if (!empty($selectedSizes)) {
            $productsQuery->whereHas('items', function ($query) use ($selectedSizes) {
                $query->whereHas('sizes', function ($query) use ($selectedSizes) {
                    $query->whereIn('size_id', $selectedSizes);
                });
            });
        }

        // Filtrar por rango de precios, considerando sale_price y original_price
        /* if ($minPrice && $maxPrice) {
            $productsQuery->whereHas('items', function ($query) use ($minPrice, $maxPrice) {
                $query->where(function ($query) use ($minPrice, $maxPrice) {
                    // Verifica si sale_price está dentro del rango
                    $query->whereBetween('sale_price', [$minPrice, $maxPrice])->orWhere(function ($query) use ($minPrice, $maxPrice) {
                        // Si sale_price es NULL, entonces original_price debe estar dentro del rango
                        $query->whereNull('sale_price')->whereBetween('original_price', [$minPrice, $maxPrice]);
                    });
                });
            });
        } */

        // Obtener los productos filtrados
        $products = $productsQuery->get();

        // Obtener todas las categorías en estructura jerárquica
        $categories = Category::all();


        // Obtener todos los talles
        $sizes = Size::all();
        $combos = Combo::all();

        /* @dd($products); */
        return view('products.filter', compact('products', 'categories', 'sizes', 'combos'));
    }
}
