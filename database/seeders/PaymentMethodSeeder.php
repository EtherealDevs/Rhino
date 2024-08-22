<?php

namespace Database\Seeders;
use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentMethod::create([
            'payment_method' => 'efectivo'
        ]);
        PaymentMethod::create([
            'payment_method' => 'mercado_pago'
        ]);
        PaymentMethod::create([
            'payment_method' => 'tarjeta_debito'
        ]);
        PaymentMethod::create([
            'payment_method' => 'tarjeta_credito'
        ]);
    }
}
