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
        $productVariations = $item->product->items->load('sizes')->filter(function (ProductItem $variation, int $key) use ($item) {
            foreach ($variation->sizes as $size) {
                if ($size->pivot->deleted_at == null && $variation->id != $item->id) {
                    return true;
                }
            }
        });
        $colors = $item->colors();
        $reviews = Reviews::with('user', 'product')->get();

        // Obtener productos relacionados
        $relatedProducts = Product::with(['items.images'])
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id) // Excluir el producto actual
            ->take(4) // Limitar a 4 productos relacionados
            ->get();

        return view('products.show', compact('item', 'productVariations', 'colors', 'itemVariations', 'reviews', 'averageRating', 'relatedProducts'));
    }

    public function filter(Request $request)
    {
        $selectedCategories = $request->input('categories', []);
        $selectedSizes = $request->input('sizes', []);
        $minPrice = $request->input('minprice', 0);
        $maxPrice = $request->input('maxprice', 500000);

        $productsQuery = Product::query();

        if (!empty($selectedCategories)) {
            $productsQuery->whereIn('category_id', $selectedCategories);
        }

        if (!empty($selectedSizes)) {
            $productsQuery->whereHas('items', function ($query) use ($selectedSizes) {
                $query->whereHas('sizes', function ($query) use ($selectedSizes) {
                    $query->whereIn('size_id', $selectedSizes);
                });
            });
        }

        dd($productsQuery);
        $products = Product::whereHas('items', function ($query) use ($minPrice, $maxPrice) {
            $query->where(function ($query) use ($minPrice, $maxPrice) {
                // Filtramos por sale_price en el rango
                $query->whereBetween('sale_price', [$minPrice, $maxPrice])
                    ->orWhere(function ($query) use ($minPrice, $maxPrice) {
                        // O filtramos por original_price si sale_price es nulo
                        $query->whereNull('sale_price')
                            ->whereBetween('original_price', [$minPrice, $maxPrice]);
                    });
            })
                // Aseguramos que no esté marcado como eliminado
                ->whereNull('deleted_at');
        })
            // Aseguramos que el producto no esté marcado como eliminado
            ->whereNull('products.deleted_at')
            ->get();

        $products = $productsQuery->get();
        $categories = Category::all();
        $sizes = Size::all();
        $combos = Combo::all();

        return view('products.filter', compact('products', 'categories', 'sizes', 'combos'));
    }
}
