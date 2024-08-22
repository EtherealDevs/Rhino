<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Order;

class AdminPanel extends Component
{
    public $user;
    public $pendingOrders;

    public function mount()
    {
        $this->user = Auth::user();
        // Obtener los pedidos pendientes y cargar la relación address
        $this->pendingOrders = Order::with('address')->where('order_status_id', 1)->get();
    }
    

    public function render()
    {
        return view('livewire.admin.admin-panel', [
            'user' => $this->user,
            'pendingOrders' => $this->pendingOrders,
        ]);
    }
}
