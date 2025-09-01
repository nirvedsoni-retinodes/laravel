<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Create permissions
        $permissions = [
            'view-bookings',
            'create-bookings',
            'edit-bookings',
            'delete-bookings',
            'manage-venues',
            'manage-facilities',
            'manage-users',
            'manage-schedules',
            'view-reports',
            'admin-bookings',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles
        $player = Role::create(['name' => 'player']);
        $manager = Role::create(['name' => 'manager']);
        $admin = Role::create(['name' => 'admin']);

        // Assign permissions to roles
        $player->givePermissionTo([
            'view-bookings',
            'create-bookings',
        ]);

        $manager->givePermissionTo([
            'view-bookings',
            'create-bookings',
            'edit-bookings',
            'manage-venues',
            'manage-facilities',
            'manage-schedules',
            'view-reports',
        ]);

        $admin->givePermissionTo($permissions);
    }
}
