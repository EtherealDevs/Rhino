<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Address;
use App\Models\Province;
use App\Models\User;
use App\Models\ZipCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $zipCodes = ZipCode::all();
        foreach ($users as $user) {
            $zipCode = $zipCodes->random(1)->first();
            Address::factory(2)->for($user)->create([
                'zip_code_id' => $zipCode->id,
                'province_id' => $zipCode->province,
                'city_id' => $zipCode->province->cities->random(1)->first()->id
            ]);
        }
    }
}
