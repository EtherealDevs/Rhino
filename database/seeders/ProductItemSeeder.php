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
        foreach ($public->files('images/product') as $file) {
            $public->delete($file);
        }

        $productItemCount = 0; // Contador de ProductItems creados
        $maxProductItems = 10; // Límite de ProductItems a crear

        foreach (Product::all() as $product) {
            foreach (Color::all() as $key => $color) {
                if ($productItemCount >= $maxProductItems) {
                    break 2; // Rompe ambos bucles cuando se alcanza el límite
                }

                $size = Size::all()->random(2);
                $count = $key == 0 ? 2 : rand(1, 2);

                ProductItem::factory()
                    ->hasAttached($size, ['stock' => rand(1, 3)])
                    ->hasImages($count)
                    ->create([
                        'product_id' => $product->id,
                        'color_id' => $color->id
                    ]);

                $productItemCount++; // Incrementa el contador
            }
        }
    }

}
