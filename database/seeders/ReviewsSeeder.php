<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reviews;

class ReviewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reviews::create([
            'user_id' => 1, // ID del usuario
            'product_id' => 1, // ID del producto
            'content' => 'Excelente producto, lo recomiendo totalmente.',
            'rating' => 5,
        ]);

        Reviews::create([
            'user_id' => 2,
            'product_id' => 1,
            'content' => 'Buena calidad, aunque el tamaño no es exacto.',
            'rating' => 4,
        ]);

        Reviews::create([
            'user_id' => 3,
            'product_id' => 2,
            'content' => 'No estoy satisfecho con la compra, llegó dañado.',
            'rating' => 1,
        ]);

        Reviews::create([
            'user_id' => 4,
            'product_id' => 2,
            'content' => 'Producto decente, pero esperaba más.',
            'rating' => 3,
        ]);

    }
}
