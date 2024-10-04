<?php

namespace App\Http\Controllers;

use App\Models\Product;  
use Illuminate\Http\Request;
use App\Models\Category;


class PromoController extends Controller
{
    /**
     * Muestra la vista 'index' con productos en promoción.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Obtener productos que están en promoción
        $products = Product::whereHas('sale', function ($query) {
            
        })->get();



        return view('promos.index', compact('products'));
    }
}
