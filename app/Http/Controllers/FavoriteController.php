<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function addToFavorites($productId)
    {
        Favorite::create([
            'user_id' => auth()->id(),
            'product_id' => $productId,
            // Puedes agregar campos adicionales como color, talla, etc.
        ]);

        return back()->with('success', 'Producto agregado a favoritos');
    }

    public function add(Request $request)
{
    $product = Product::find($request->product_id);
    if (!$product) {
        return back()->withErrors('El producto no existe.');
    }

    $favorite = Favorite::firstOrCreate([
        'user_id' => auth()->id(),
        'product_id' => $request->product_id,
    ]);

    return back()->with('success', 'Producto agregado a favoritos.');
}

}
