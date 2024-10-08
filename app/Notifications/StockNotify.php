<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Product;
use Illuminate\Http\Request;

class StockNotify extends Notification
{
    use Queueable;

    protected $product;

    /**
     * Create a new notification instance.
     *
     * @param Product $product
     */
    // En el constructor de la notificación
    public function __construct(Product $product, Request $request)
    {
        // Asegúrate de que estás usando la variable correcta
        $this->product = $product; // Guarda el producto en la propiedad

        // Puedes realizar una verificación adicional si deseas asegurarte
        // de que el producto exista
        if (!$this->product) {
            throw new \InvalidArgumentException("El producto no existe.");
        }
    }


    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Stock bajo: ' . $this->product->name)
            ->line('El stock del producto "' . $this->product->name . '" es menor o igual a 5 unidades.')
            ->action('Ver Producto', url('/admin/products/' . $this->product->id))
            ->line('Por favor, actualiza el stock lo antes posible.');
    }

    /**
     * Guardar la notificación en la base de datos.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'product_id' => $this->product->id,
            'name' => $this->product->name,
            'stock' => $this->product->stock,
            'message' => 'El stock está por debajo del umbral.'
        ];
    }
}
