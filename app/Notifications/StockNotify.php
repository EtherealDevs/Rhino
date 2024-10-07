<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;

class StockBajoNotification extends Notification
{
    use Queueable;

    private $product;

    public function __construct($product)
    {
        $this->product = $product;
    }

    public function via($notifiable)
    {
        // Notificación a través de base de datos
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'product_id' => $this->product->id,
            'message' => "El producto {$this->product->name} ({$this->product->size}) tiene un stock bajo ({$this->product->stock} unidades restantes).",
            'stock_restante' => $this->product->stock,
        ];
    }


}
