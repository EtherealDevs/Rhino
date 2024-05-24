<?php

namespace Database\Seeders;

use App\Models\Combo;
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
            $items = ProductItem::all('id')->random($amountOfProducts)->toJson();
            Combo::create([
                'items' => $items,
                'discount' => $discount[rand(0, 2)]
            ]);
        }
    }
}
