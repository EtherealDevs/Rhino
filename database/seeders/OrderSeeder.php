<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\App;

class OrderSeeder extends Seeder
{
    public function run()
    {
        // Si necesitas obtener IDs específicos de las tablas relacionadas
        // $userId = DB::table('users')->first()->id;
        // $paymentMethodId = DB::table('payment_methods')->first()->id;
        // $deliveryServiceId = DB::table('delivery_services')->first()->id;
        // $addressId = DB::table('addresses')->first()->id;
        // $orderStatusId = DB::table('order_statuses')->first()->id;

        // Inserción de datos de ejemplo
        DB::table('orders')->insert([
            [
                'user_id' => 1, // Reemplaza con un ID válido de usuario
                'payment_method_id' => 1, // Reemplaza con un ID válido de método de pago
                'total' => 1000,
                'delivery_service_id' => 1, // Reemplaza con un ID válido de servicio de entrega
                'delivery_price' => '10.00',
                'address_id' => 1, // Reemplaza con un ID válido de dirección
                'order_status_id' => 1, // Reemplaza con un ID válido de estado de pedido
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2, // Reemplaza con un ID válido de usuario
                'payment_method_id' => 2, // Reemplaza con un ID válido de método de pago
                'total' => 2000,
                'delivery_service_id' => 2, // Reemplaza con un ID válido de servicio de entrega
                'delivery_price' => '20.00',
                'address_id' => 2, // Reemplaza con un ID válido de dirección
                'order_status_id' => 2, // Reemplaza con un ID válido de estado de pedido
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Añade más órdenes si es necesario
        ]);
    }
}
