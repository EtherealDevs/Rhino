<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Inserción de datos de ejemplo en la tabla payment_methods
        DB::table('payment_methods')->insert([
            [
                'payment_method' => 'Credit Card',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'payment_method' => 'PayPal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'payment_method' => 'Bank Transfer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'payment_method' => 'Cash on Delivery',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
