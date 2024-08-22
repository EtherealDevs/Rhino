<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provincias = File::json('public/storage/json/argentina_states.json');
        foreach ($provincias as $provincia) {
            Province::create([
                'name' => $provincia['name']
            ]);
        }
    }
}
