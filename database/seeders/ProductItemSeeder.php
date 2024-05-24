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
                foreach (Size::all() as $size) {
                    ProductItem::factory()->create([
                        'product_id' => $product->id,
                        'color_id' => $color->id,
                        'size_id' => $size->id
                    ]);
                }
            }
        }
    }
}
