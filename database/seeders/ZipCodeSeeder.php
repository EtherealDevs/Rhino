<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Province;
use App\Models\ZipCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ZipCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provincias = File::json('public/storage/json/argentina_states.json');
        $codigosPostales = File::json('public/storage/json/argentina_zipcodes.json');
        $provincias = Province::all();
        
        foreach ($codigosPostales as $key => $codigo) {
            ZipCode::create([
                'code' => $codigo['CP'],
                'province_id' => $provincias->where('name', '=', $codigo['Provincia'])->first()->id
                ]);
        }

    }
}
