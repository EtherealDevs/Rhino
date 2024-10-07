<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductsSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\StockNotify; // Importa la notificación
use App\Models\User;

class StockController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.stock.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.stock.create');
    }

    public function store(Request $request)
    {
        // Obtenemos el registro del tamaño del producto que se va a actualizar
        $product_size = DB::table('products_sizes')
            ->where('product_item_id', $request->product_id)
            ->where('size_id', $request->size_id)
            ->first();

        // Actualizamos el stock
        DB::table('products_sizes')
            ->where('product_item_id', $request->product_id)
            ->where('size_id', $request->size_id)
            ->update([
                'stock' => $request->stock,
            ]);

        // Verificamos si el stock está por debajo del umbral
        if ($request->stock <= 5) {
            // Obtenemos al administrador (o puedes obtener múltiples administradores)
            $admin = User::where('role', 'admin')->first();

            // Encontramos el producto para la notificación
            $product = Product::find($request->product_id);

            // Notificamos al administrador
            $admin->notify(new StockNotify($product));
        }

        // Redirigimos a la lista de productos en stock
        return redirect()->route('admin.stock.index');
    }
}
