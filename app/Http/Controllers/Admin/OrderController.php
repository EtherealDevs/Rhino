<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

class OrderController extends Controller
{
    public function index()
    {
        // Filtrar los pedidos con order_status_id igual a 1
        $orders = Order::with('user', 'details', 'orderStatus')
            ->get();

        $orderStatuses = OrderStatus::all(); // Obtén todos los estados posibles

        return view('admin.orders.index', compact('orders', 'orderStatuses'));
    }

    public function ventas()
    {
        // Filtrar los pedidos con order_status_id igual a 4
        $orders = Order::with('user', 'details', 'orderStatus')
            ->get();

        $ventas = Order::where('order_status_id', 4)->get();

        // Calcular el total de ganancias
        $totalGanancias = $orders->sum('total');

        $orderStatuses = OrderStatus::all();

        $orderStatuses = OrderStatus::all(); // Obtén todos los estados posibles

        return view('admin.ventas.index', compact('ventas', 'orders', 'orderStatuses', 'totalGanancias'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'order_status_id' => 'required|exists:order_statuses,id',
        ]);

        $order->update([
            'order_status_id' => $request->input('order_status_id'),
        ]);

        return redirect()->back();
    }

    public function create()
    {
        $statuses = OrderStatus::all();
        return view('admin.orders.create', compact('statuses'));
    }

    // Método show para visualizar el detalle de un pedido específico
    public function show($id)
    {
        $mpAccessToken = config('app.mp_access_token');
        MercadoPagoConfig::setAccessToken($mpAccessToken);
        $client = new PaymentClient();

        $order = Order::with('user', 'details', 'orderStatus', 'paymentMethod', 'deliveryService', 'address')
            ->findOrFail($id);
        $mpOrder = null;
        // Mercado Pago: Obtener la información del pedido
        if ($order->mp_order_id != null) {
            try {
                $mpOrder = $client->get($order->mp_order_id);
            } catch (MPApiException $th) {
                dd($th);
            }
        }
        $mpOrderJson = json_encode($mpOrder);
        // Filtrar los pedidos con order_status_id igual a 1

        $orderStatuses = OrderStatus::all(); // Obtén todos los estados posibles

        return view('admin.orders.show', compact('order', 'mpOrderJson', 'mpOrder', 'orderStatuses'));
    }
}
