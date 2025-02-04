<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\OrderStatus;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            ColorSeeder::class,
            SizeSeeder::class,
            ProductSeeder::class,
            ProductItemSeeder::class,
            ComboSeeder::class,
            /* FavoriteSeeder::class, */
            ProvinceSeeder::class,
            CitySeeder::class,
            ZipCodeSeeder::class,
            AddressSeeder::class,
            PaymentMethodSeeder::class,
            DeliveryServiceSeeder::class,
            OrderStatusSeeder::class,
            OrderSeeder::class,
            // OrderDetailSeeder::class,
            ReviewsSeeder::class,
        ]);
    }
}
