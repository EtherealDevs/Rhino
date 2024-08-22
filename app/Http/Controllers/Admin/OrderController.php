<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // Filtrar los pedidos con order_status_id igual a 1
        $orders = Order::with('user', 'details.productItem', 'orderStatus')
            ->get();

        $orderStatuses = OrderStatus::all(); // Obtén todos los estados posibles

        return view('admin.orders.index', compact('orders', 'orderStatuses'));
    }

    public function ventas()
    {
        // Filtrar los pedidos con order_status_id igual a 4
        $orders = Order::with('user', 'details.productItem', 'orderStatus')
            ->get();

            $ventas = Order::where('order_status_id', 4)->get();

             // Calcular el total de ganancias
        $totalGanancias = $orders->sum('total');

        $orderStatuses = OrderStatus::all();

        $orderStatuses = OrderStatus::all(); // Obtén todos los estados posibles

        return view('admin.ventas.index', compact('orders', 'orderStatuses', 'totalGanancias'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'order_status_id' => 'required|exists:order_statuses,id',
        ]);

        $order->update([
            'order_status_id' => $request->input('order_status_id'),
        ]);

        return redirect()->route('admin.orders.index')->with('success', 'Estado del pedido actualizado.');
    }

    public function create()
    {
        $statuses = OrderStatus::all();
        return view('admin.orders.create', compact('statuses'));
    }

    // Método show para visualizar el detalle de un pedido específico
    public function show($id)
    {
        $order = Order::with('user', 'details.productItem', 'orderStatus', 'paymentMethod', 'deliveryService', 'address')
            ->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }
}
