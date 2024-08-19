<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        // Obtener el usuario actualmente autenticado
        $user = Auth::user();

        // Obtener solo los pedidos que pertenecen al usuario logueado
        $orders = Order::with('details.productItem', 'orderStatus')
            ->where('user_id', $user->id)
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        // Obtener el usuario actualmente autenticado
        $user = Auth::user();

        // Asegurarse de que el pedido pertenece al usuario logueado
        $order = Order::with('details.productItem', 'orderStatus')
            ->where('user_id', $user->id)
            ->findOrFail($id);

        return view('orders.show', compact('order'));
    }
}

