<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleAfiliado = Role::create(['name' => 'afiliado']);

        Permission::create(['name' => 'dashboard.index'])->syncRoles([$roleAdmin]);

        Permission::create(['name' => 'dashboard.stores.files'])->syncRoles([$roleAdmin]);
        Permission::create(['name' => 'dashboard.stores.index'])->syncRoles([$roleAdmin]);
        Permission::create(['name' => 'dashboard.stores.showMyStore'])->syncRoles([$roleAfiliado]);
        Permission::create(['name' => 'dashboard.stores.create'])->syncRoles([$roleAdmin]);
        Permission::create(['name' => 'dashboard.stores.edit'])->syncRoles([$roleAdmin, $roleAfiliado]);
        Permission::create(['name' => 'dashboard.stores.delete'])->syncRoles([$roleAdmin]);

        Permission::create(['name' => 'dashboard.categories.files'])->syncRoles([$roleAdmin]);
        Permission::create(['name' => 'dashboard.categories.index'])->syncRoles([$roleAdmin]);
        Permission::create(['name' => 'dashboard.categories.create'])->syncRoles([$roleAdmin]);
        Permission::create(['name' => 'dashboard.categories.edit'])->syncRoles([$roleAdmin]);
        Permission::create(['name' => 'dashboard.categories.delete'])->syncRoles([$roleAdmin]);

        Permission::create(['name' => 'dashboard.events.files'])->syncRoles([$roleAdmin]);
        Permission::create(['name' => 'dashboard.events.index'])->syncRoles([$roleAdmin]);
        Permission::create(['name' => 'dashboard.events.create'])->syncRoles([$roleAdmin]);
        Permission::create(['name' => 'dashboard.events.edit'])->syncRoles([$roleAdmin]);
        Permission::create(['name' => 'dashboard.events.delete'])->syncRoles([$roleAdmin]);

        Permission::create(['name' => 'dashboard.users.logo'])->syncRoles([$roleAdmin]);
        Permission::create(['name' => 'dashboard.users.index'])->syncRoles([$roleAdmin]);
        Permission::create(['name' => 'dashboard.users.create'])->syncRoles([$roleAdmin]);
        Permission::create(['name' => 'dashboard.users.edit'])->syncRoles([$roleAdmin]);
        Permission::create(['name' => 'dashboard.users.delete'])->syncRoles([$roleAdmin]);
    }
}
