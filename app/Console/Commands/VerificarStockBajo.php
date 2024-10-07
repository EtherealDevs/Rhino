<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\User;
use App\Notifications\StockBajoNotification;

class VerificarStockBajo extends Command
{
    protected $signature = 'verificar:stockbajo';
    protected $description = 'Verificar productos con stock bajo';

    public function handle()
    {
        $products = Product::where('stock', '<=', 5)->get();
        $admin = User::where('role', 'admin')->first();

        foreach ($products as $product) {
            // Notificar si no se ha notificado antes sobre este producto
            if (!$admin->notifications->where('data.product_id', $product->id)->count()) {
                $admin->notify(new StockBajoNotification($product));
            }
        }

        $this->info('Verificación de stock bajo completada.');
    }
}
