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
        function checkIfZipCodeInsideArray($array, $zipCodeArray, $key)
        {
            foreach ($array as $arrayItem) {
                if ($arrayItem[$key] == $zipCodeArray[$key]) {
                    return true;
                };
            };
        }

        $provincias = File::json('public/storage/json/argentina_states.json');
        $codigosPostales = File::json('public/storage/json/argentina_zipcodes_updated.json');
        $codigosPostalesCABA = File::json('public/storage/json/argentina_zipcodes_CABA.json');
        $provincias = Province::all();

        $codigosPostalesSinDuplicados = [];

        foreach ($codigosPostales['localidad'] as $codigo) {
            $arr = ['codigopostal' => $codigo['codigopostal'], 'provincia_nombre' => $codigo['provincia_nombre']];
            if (!checkIfZipCodeInsideArray($codigosPostalesSinDuplicados, $arr, 'codigopostal')) {
                array_push($codigosPostalesSinDuplicados, $arr);
            }
        }


        $capitalFederal = $provincias->where('name', '=', 'Capital Federal')->first();
        foreach ($codigosPostalesCABA as $codigo) {
            ZipCode::create([
                'code' => $codigo['CP'],
                'province_id' => $capitalFederal->id
                ]);
        }
        
        foreach ($codigosPostalesSinDuplicados as $codigo) {
            ZipCode::create([
                'code' => $codigo['codigopostal'],
                'province_id' => $provincias->where('name', '=', $codigo['provincia_nombre'])->first()->id
                ]);
        }

    }
}

