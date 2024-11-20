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
    public $product;
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

        $this->product = $product;
        // Obtener las variedades de talla del producto
        $itemVariations = ProductSize::where('product_item_id', $id)->get();
        if ($itemVariations == null || $itemVariations->isEmpty()) {
            return abort(404);
        }

        $averageRating = $product->reviews()->avg('rating');
        $averageRating = round($averageRating * 2) / 2; // Redondear al valor más cercano de media estrella


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
        $reviews = Reviews::with('user', 'product')
            ->where('product_id', $product->id) // Filtrar por el producto actual
            ->get();

        // Obtener productos relacionados
        $relatedProducts = Product::with(['items.images'])
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id) // Excluir el producto actual
            ->take(4) // Limitar a 4 productos relacionados
            ->get();

        return view('products.show', compact('item', 'productVariations', 'product', 'colors', 'itemVariations', 'reviews', 'averageRating', 'relatedProducts'));
    }

    public function filter(Request $request)
    {
        $selectedCategories = $request->input('categories', []);
        $selectedSizes = $request->input('sizes', []);
        $minPrice = $request->input('minprice', 0) * 100;
        $maxPrice = $request->input('maxprice', 300000) * 100;

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

        $productsQuery->whereHas('items', function ($query) use ($minPrice, $maxPrice) {
            $query->where(function ($query) use ($minPrice, $maxPrice) {

                $query->whereBetween('sale_price', array($minPrice, $maxPrice))
                    ->orWhere(function ($query) use ($minPrice, $maxPrice) {
                        $query->whereNull('sale_price')
                            ->whereBetween('original_price', array($minPrice, $maxPrice));
                    });
            })
                ->whereNull('deleted_at');
        })
            ->whereNull('products.deleted_at');

        $products = $productsQuery->get();
        $categories = Category::all();
        $sizes = Size::all();
        $combos = Combo::all();

        return view('products.filter', compact('products', 'categories', 'sizes', 'combos'));
    }
}
