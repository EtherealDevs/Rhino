<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderDetailSeeder extends Seeder
{
    public function run()
    {
        // Inserción de datos de ejemplo
        DB::table('order_details')->insert([
            [
                'order_id' => 1, // Reemplaza con un ID válido de orden
                'product_item_id' => 1, // Reemplaza con un ID válido de producto
                'amount' => 2,
                'price' => 500, // Precio por unidad
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 1, // Reemplaza con un ID válido de orden
                'product_item_id' => 2, // Reemplaza con un ID válido de producto
                'amount' => 1,
                'price' => 500, // Precio por unidad
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 2, // Reemplaza con un ID válido de orden
                'product_item_id' => 3, // Reemplaza con un ID válido de producto
                'amount' => 3,
                'price' => 200, // Precio por unidad
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Añade más detalles de orden si es necesario
        ]);
    }
}
