<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Obtener el pedido con id 1
        $pendingOrders = Order::where('id', 1)->get();

        return view('admin.index', compact('user', 'pendingOrders'));
    }

    public function show($id)
{
    $order = Order::with('user', 'details.productItem', 'orderStatus', 'paymentMethod', 'deliveryService', 'address')->findOrFail($id);

    return view('admin.orders.show', compact('order'));
}

}
