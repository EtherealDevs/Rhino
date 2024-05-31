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
        foreach (Product::all() as $product) {
            foreach (Color::all() as $color) {
                $test = Size::all()->random(1)->first();
                ProductItem::factory()->hasAttached($test, ['stock' => rand(1, 3)])->create([
                    'product_id' => $product->id,
                    'color_id' => $color->id
                ]);
            }
        }
    }
}
