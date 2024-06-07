<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\Size;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\error;

class ProductItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $public = Storage::disk('public');
        foreach ($public->files() as $file)
        {
            $public->delete($file);
        }
        foreach (Product::all() as $product) {
            foreach (Color::all() as $key => $color) {
                $test = Size::all()->random(1)->first();
                if ($key == 0) {
                    $count = 2;
                }
                else {
                    $count = rand(1, 2);
                }
                ProductItem::factory()->hasAttached($test, ['stock' => rand(1, 3)])->hasImages($count)->create([
                    'product_id' => $product->id,
                    'color_id' => $color->id
                ]);
            }
        }
    }
}
