<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliveryServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Inserción de datos de ejemplo en la tabla delivery_services
        DB::table('delivery_services')->insert([
            [
                'name' => 'Standard Shipping',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Express Shipping',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Overnight Shipping',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Local Pickup',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
