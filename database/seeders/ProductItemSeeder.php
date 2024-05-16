<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Size::all() as $size) {
            foreach (Color::all() as $color) {
                Product::first()->items()->create([
                    'description' => 'a description',
                    'original_price' => 19.99,
                    'sale_price' => 9.99,
                    'color_id' => $color->id,
                    'size_id' => $size->id
                ]);
            }
        }
    }
}
