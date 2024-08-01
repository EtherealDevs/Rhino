<?php

namespace Database\Seeders;

use App\Models\Combo;
use App\Models\Combo_items;
use App\Models\Product;
use App\Models\ProductItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComboSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [];
        for ($i=0; $i < 3; $i++) { 
            $amountOfProducts = rand(2, 10);
            $discount = [5, 10, 20];
            $combo= Combo::create([
                'discount' => $discount[rand(0, 2)]
            ]);

            for($j=0; $j < $amountOfProducts; $j++){
                $product = Product::inRandomOrder()->first();
                Combo_items::create([
                    'combo_id' => $combo->id,
                    'product_id' => $product->id
                ]);
            }
        }
    }
}
