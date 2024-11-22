<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductItem;
use App\Models\Sale;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // Obtener los tres últimos ProductItem
        // $latestProductItems = ProductItem::orderBy('created_at', 'desc')->get();
        $latestProductItems = ProductItem::getAvailable()->orderBy('created_at', 'desc')->get()->unique('product_id')->take(3);
        $sales = Sale::all();

        // Configurar la zona horaria
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $now = Carbon::now('America/Argentina/Buenos_Aires')->translatedFormat('Y-m-d');

        // Eliminar las ventas que han terminado
        foreach ($sales as $sale) {
            if ($sale->end_date == $now) {
                Sale::destroy($sale->id);
            }
        }
        // Pasar los datos a la vista
        return view('home.index', compact('latestProductItems', 'sales'));
    }
}
