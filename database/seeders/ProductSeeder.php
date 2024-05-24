<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Category::all() as $category) {
            foreach (Brand::all() as $brand) {
                Product::factory(1)->create([
                    'brand_id' => $brand->id,
                    'category_id' => $category->id
                ]);
            }
        }
    }
}
