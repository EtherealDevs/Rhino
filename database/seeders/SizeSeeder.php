<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Size::create([
            'name' => 'S',
            'sort_number' => 1
        ]);
        Size::create([
            'name' => 'M',
            'sort_number' => 2
        ]);
    }
}
