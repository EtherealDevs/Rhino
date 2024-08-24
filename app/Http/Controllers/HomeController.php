<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductItem;
use App\Models\Combo;
use App\Models\Sale;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // Obtener el primer ProductItem, todas las Combos y todas las Sales
        $productItem = ProductItem::first();
        $combos = Combo::all();
        $sales = Sale::all();

        // Configurar la zona horaria
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $now = Carbon::now('America/Argentina/Buenos_Aires')->translatedFormat('Y-m-d');

        // Eliminar las ventas que han terminado
        foreach ($sales as $sale) {
            if ($sale->end_date == $now) {
                Sale::destroy($sale->id);  // Cambiar SaleController::destroy a Sale::destroy
            }
        }

        smilify('success', 'Iniciaste sesion con exito');
        // Pasar los datos a la vista
        return view('home.index', compact('productItem', 'sales', 'combos'));
    }
}
