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
    public function show(Product $product, $id)
    {
        $item = ProductItem::with(['product' => ['items' => ['color'], 'category'], 'sizes', 'images'])
            ->where('id', $id)
            ->first();
        $colors = $item->colors();
        return view('products.show', compact('item', 'colors'));
    }
    public function addToCart(Request $request, Product $product, ProductItem $productItem)
    {
        $request->validate([
            'amount' => 'required',
            'size' => 'required',
        ]);
        CartManager::addItem($productItem, $request->amount, $request->size);

        //Check if user logged in. If true persist the Cart to Database
        if (Auth::check()) {
            $user = User::where('id', Auth::user()->id)->first();
            CartManager::storeOrUpdateInDatabase($user);
            $cart = Cart::where('user_id', $user->id)->first();
        }

        if (session('cartError')) {
            return redirect()->route('cart')->with('failure', session('cartError'));
        }

        notify()->success('Producto agregado ⚡️');
        return redirect()->route('cart')->with('success', 'true');
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
        if ($minPrice && $maxPrice) {
            $productsQuery->whereHas('items', function ($query) use ($minPrice, $maxPrice) {
                $query->where(function ($query) use ($minPrice, $maxPrice) {
                    // Verifica si sale_price está dentro del rango
                    $query->whereBetween('sale_price', [$minPrice, $maxPrice])->orWhere(function ($query) use ($minPrice, $maxPrice) {
                        // Si sale_price es NULL, entonces original_price debe estar dentro del rango
                        $query->whereNull('sale_price')->whereBetween('original_price', [$minPrice, $maxPrice]);
                    });
                });
            });
        }

        // Obtener los productos filtrados
        $products = $productsQuery->paginate(12);

        // Obtener todas las categorías en estructura jerárquica
        $categories = Category::hierarchicalCategories();

        // Obtener todos los talles
        $sizes = Size::all();
        $combos = Combo::all();

        return view('products.filter', compact('products', 'categories', 'sizes', 'combos'));
    }
}
