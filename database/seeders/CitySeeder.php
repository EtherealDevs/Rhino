<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // function in_array_r($needle, $haystack, $strict = false) {
        //     foreach ($haystack as $item) {
        //         if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
        //             return true;
        //         }
        //     }
        
        //     return false;
        // }
        // function in_array_test($province, $city, $haystack, $strict = false) {
        //     foreach ($haystack as $item) {
        //         if (($strict ? $item['Provincia'] === $province : $item['Provincia'] == $province) && ($strict ? $item['Localidad'] === $city : $item['Localidad'] == $city)) {
        //             return true;
        //         }
        //     }
        
        //     return false;
        // }
        // $jsonData = File::json('public/storage/json/argentina_zipcodes.json');
        // $cities = [];
        // foreach ($jsonData as $key => $data) {
        //     if (in_array_test($data['Provincia'], $data['Localidad'], $cities)) {
        //         continue;
        //     };
        //     $newData = [
        //         'Provincia' => $data['Provincia'],
        //         'Localidad' => $data['Localidad']
        //     ];
        //     array_push($cities, $newData);
        // }
        $cities = File::json('public/storage/json/argentina_departamentos.json');
        
        $provincias = Province::all();
        foreach ($cities['departamentos'] as $data) {
            $city = City::create([
                'name' => $data['nombre'],
                'province_id' => $provincias->where('name', '=', $data['provincia']['nombre'])->first()->id
            ]);
        }
    }
}
