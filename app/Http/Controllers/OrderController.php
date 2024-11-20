<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\TransferInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        // Obtener el usuario actualmente autenticado
        $user = Auth::user();

        // Obtener solo los pedidos que pertenecen al usuario logueado
        $orders = Order::with('details', 'orderStatus')
            ->where('user_id', $user->id)
            ->get();


        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        // Obtener el usuario actualmente autenticado
        $user = Auth::user();

        // Asegurarse de que el pedido pertenece al usuario logueado
        $order = Order::with('details', 'orderStatus')
            ->where('user_id', $user->id)
            ->findOrFail($id);

        // Obtener la información de transferencia
        $transferInfo = TransferInfo::first(); // Obtiene la primera entrada
        $tracking = DeliveryServiceController::track($order->send_number);

        // Pasar el pedido y la información de transferencia a la vista
        return view('orders.show', compact('order', 'transferInfo','tracking'));
    }
}

