<?php

namespace Database\Seeders;

use App\Models\ProductItem;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (User::all() as $user) {
            $user->items()->attach(ProductItem::all()->random(rand(1, 3))->first()->id);
        }
    }
}
