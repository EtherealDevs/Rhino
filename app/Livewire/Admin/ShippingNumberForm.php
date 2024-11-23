<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Order;

class ShippingNumberForm extends Component
{
    public $orderId;  // Almacenamos el ID de la orden
    public $sendNumber;  // Almacenamos el número de envío

    // Método para cargar la orden
    public function mount($orderId)
    {
        $this->orderId = $orderId;

        // Obtener la orden desde la base de datos
        $order = Order::find($this->orderId);
        if ($order) {
            $this->sendNumber = $order->send_number;  // Cargar el número de envío si existe
        } else {
            session()->flash('error', 'La orden no existe.');
        }
    }

    // Método para actualizar el número de envío
    public function save()
    {
        $this->validate([
            'sendNumber' => 'required|string',  // Validar que el número de envío no esté vacío
        ]);

        try {
            // Buscar la orden y actualizar el número de envío
            $order = Order::findOrFail($this->orderId);
            $order->update([
                'send_number' => $this->sendNumber,
            ]);

            session()->flash('message', 'Número de envío actualizado correctamente.');  // Mensaje de éxito
        } catch (\Exception $e) {
            session()->flash('error', 'Hubo un error al actualizar el número de envío.');
        }
    }

    public function render()
    {
        return view('livewire.admin.shipping-number-form');
    }
}
