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

        // Obtén las categorías hijas, incluidas las nietas
        $categoriesTree = Category::hierarchicalCategories($categoryId);

        // Recopila los IDs de todas las categorías hijas y nietas
        $categoryIds = collect([$categoryId]);
        $flattenCategories = function ($categories) use (&$flattenCategories, &$categoryIds) {
            foreach ($categories as $child) {
                $categoryIds->push($child->id);
                if ($child->children) {
                    $flattenCategories($child->children);
                }
            }
        };
        $flattenCategories($categoriesTree);

        // Obtén todos los productos de las categorías seleccionadas
        $products = Product::whereIn('category_id', $categoryIds)->get();

        // Todas las categorías para el menú
        $categories = Category::all();

        // Pasa la categoría y los productos a la vista
        return view('collection.index', compact('category', 'products', 'categories', 'categoriesTree'));
    }
}
