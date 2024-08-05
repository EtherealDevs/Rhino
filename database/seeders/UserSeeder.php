<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'name' => 'Admin1',
            'last_name' => 'Admin1',
            'email' => 'admin@example.com',
            'password' => bcrypt('1234qwer')
        ])->assignRole('admin1');
        User::factory(3)->create();
    }
}
