<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index($categoryId)
    {
        // Obtén la categoría seleccionada
        $category = Category::findOrFail($categoryId);

        // Obtén las categorías hijas de la categoría seleccionada
        $childCategories = $category->subCategories;

        // Obtén todos los productos de las categorías hijas
        $products = Product::whereIn('category_id', $childCategories->pluck('id'))->get();

        // Pasa la categoría y los productos a la vista
        return view('collection.index', compact('category', 'products'));
    }
}
