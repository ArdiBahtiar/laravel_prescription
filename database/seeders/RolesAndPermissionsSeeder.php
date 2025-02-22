<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        Role::create(['name' => 'Dokter']);
        Role::create(['name' => 'Apoteker']);
        Role::create(['name' => 'Receptionist']);

        // Create Permissions
        Permission::create(['name' => 'view ticket']);
        Permission::create(['name' => 'create ticket']);
        Permission::create(['name' => 'update ticket']);
        Permission::create(['name' => 'delete ticket']);

        // Assign Role to User
        $user = User::find(1); // Replace 1 with the actual user ID
        $user->assignRole('Dokter');

        // Assign Permissions to Role
        $adminRole = Role::findByName('Dokter');
        $adminRole->givePermissionTo('update ticket');
    }
}
