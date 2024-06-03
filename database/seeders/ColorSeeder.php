<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Color::create([
            'color'=>'#F6F6F6',
            'name' => 'Traffic white'
        ]);
        Color::create([
            'color'=>'#3D642D',
            'name' => 'Fern green'
        ]);
    }
}
