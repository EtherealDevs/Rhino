<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'admin1']);
        $role2 = Role::create(['name' => 'admin2']);

        Permission::create(['name' => 'admin'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'admin.users.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.edit'])->syncRoles([$role1]);

        Permission::create(['name' => 'products.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'products.show'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'products.create'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'products.edit'])->syncRoles([$role1,$role2]);

        Permission::create(['name' => 'categories.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'categories.show'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'categories.create'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'categories.edit'])->syncRoles([$role1,$role2]);

        Permission::create(['name' => 'brands.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'brands.show'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'brands.create'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'brands.edit'])->syncRoles([$role1,$role2]);

        Permission::create(['name' => 'colors.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'colors.show'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'colors.create'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'colors.edit'])->syncRoles([$role1,$role2]);

        Permission::create(['name' => 'orders.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'orders.show'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'orders.create'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'orders.edit'])->syncRoles([$role1,$role2]);

        Permission::create(['name' => 'promos.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'promos.show'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'promos.create'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'promos.edit'])->syncRoles([$role1,$role2]);


    }
}
