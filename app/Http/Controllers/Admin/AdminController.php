<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\ProductsSize;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Obtener los pedidos pendientes
        $pendingOrders = Order::where('order_status_id', 1)->get();

        // Contar la cantidad de pedidos pendientes
        $pendingOrdersCount = $pendingOrders->count();

        // Calcular el total de ganancias para pedidos con estado 4 en los últimos 30 días
        $totalGanancias = Order::where('order_status_id', 4)
            ->whereDate('created_at', '>=', Carbon::now()->subDays(30))
            ->sum('total');

        $deliveredOrdersCount = Order::where('order_status_id', 4)->count();
        $totalStock = DB::table('products_sizes')->where('stock', 0)->count();


        return view('admin.index', compact('user', 'pendingOrders', 'totalGanancias', 'pendingOrdersCount', 'deliveredOrdersCount', 'totalStock'));
    }

    public function show($id)
    {
        $order = Order::with('user', 'details.productItem', 'orderStatus', 'paymentMethod', 'deliveryService', 'address')->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }
}
