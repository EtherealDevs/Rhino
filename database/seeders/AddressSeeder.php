<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Inserción de datos de ejemplo en la tabla addresses
        DB::table('addresses')->insert([
            [
                'user_id' => 1, // Reemplaza con un ID válido de usuario
                'street' => '123 Main St',
                'number' => 101,
                'zip_code' => 12345,
                'observation' => 'Apt 1B',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2, // Reemplaza con un ID válido de usuario
                'street' => '456 Elm St',
                'number' => 202,
                'zip_code' => 67890,
                'observation' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1, // Reemplaza con un ID válido de usuario
                'street' => '789 Oak St',
                'number' => 303,
                'zip_code' => 54321,
                'observation' => 'Near the park',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Añade más direcciones si es necesario
        ]);
    }
}
