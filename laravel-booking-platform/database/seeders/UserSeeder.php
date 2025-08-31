<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'phone' => '+919876543210',
            'address' => '123 Admin Street',
            'city' => 'Mumbai',
            'state' => 'Maharashtra',
            'postal_code' => '400001',
            'country' => 'India',
        ]);
        $admin->assignRole('admin');

        // Create manager user
        $manager = User::create([
            'name' => 'Manager User',
            'email' => 'manager@example.com',
            'password' => Hash::make('password'),
            'phone' => '+919876543211',
            'address' => '456 Manager Avenue',
            'city' => 'Mumbai',
            'state' => 'Maharashtra',
            'postal_code' => '400002',
            'country' => 'India',
        ]);
        $manager->assignRole('manager');

        // Create player user
        $player = User::create([
            'name' => 'Player User',
            'email' => 'player@example.com',
            'password' => Hash::make('password'),
            'phone' => '+919876543212',
            'address' => '789 Player Road',
            'city' => 'Mumbai',
            'state' => 'Maharashtra',
            'postal_code' => '400003',
            'country' => 'India',
        ]);
        $player->assignRole('player');

        // Create additional players
        for ($i = 1; $i <= 5; $i++) {
            $player = User::create([
                'name' => "Player {$i}",
                'email' => "player{$i}@example.com",
                'password' => Hash::make('password'),
                'phone' => "+9198765432{$i}",
                'address' => "{$i}00 Player Street",
                'city' => 'Mumbai',
                'state' => 'Maharashtra',
                'postal_code' => '40000' . $i,
                'country' => 'India',
            ]);
            $player->assignRole('player');
        }
    }
}
