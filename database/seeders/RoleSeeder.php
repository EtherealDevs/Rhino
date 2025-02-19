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
        $role1 = Role::create(['name' => 'admin']);

        Permission::create(['name' => 'admin.home'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.users.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.show'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.create'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.products.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.products.show'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.products.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.products.edit'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.categories.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.categories.show'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.categories.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.categories.edit'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.brands.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.brands.show'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.brands.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.brands.edit'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.colors.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.colors.show'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.colors.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.colors.edit'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.orders.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.orders.show'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.orders.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.orders.edit'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.promos.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.promos.show'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.promos.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.promos.edit'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.sales.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.sales.show'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.sales.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.sales.edit'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.combos.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.combos.show'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.combos.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.combos.edit'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.stock.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.stock.show'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.stock.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.stock.edit'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.ventas.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.ventas.show'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.ventas.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.ventas.edit'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.sizes.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.sizes.show'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.sizes.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.sizes.edit'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.productitems.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.productitems.show'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.productitems.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.productitems.edit'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.mystore.index'])->syncRoles([$role1]);
    }
}
