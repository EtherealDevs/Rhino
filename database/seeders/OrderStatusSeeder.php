<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusSeeder extends Seeder
{
    public function run()
    {
        DB::table('order_statuses')->insert([
            ['name' => 'Pendiente'],
            ['name' => 'Procesando'],
            ['name' => 'Enviado'],
            ['name' => 'Entregado'],
            ['name' => 'Cancelado'],            
        ]);
    }
}
