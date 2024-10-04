<?php

namespace Database\Seeders;

use App\Models\Combo;
use App\Models\Combo_items;
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
        $addedItems = [];
        for ($i=0; $i < 3; $i++) { 
            $amountOfProducts = rand(2, 10);
            $discount = [5, 10, 20];
            $combo= Combo::create([
                'discount' => $discount[rand(0, 2)]
            ]);

            for($j=0; $j < $amountOfProducts; $j++){
                $item = ProductItem::inRandomOrder()->first();
                $loopAmount = 0;
                while (in_array($item->id, $addedItems) || $loopAmount > 100) {
                    $item = ProductItem::inRandomOrder()->first();
                    $loopAmount++;
                }
                array_push($addedItems, $item->id);
                Combo_items::create([
                    'combo_id' => $combo->id,
                    'item_id' => $item->id
                ]);
            }
        }
    }
}
