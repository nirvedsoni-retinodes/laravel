<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Venue;
use App\Models\User;

class VenueSeeder extends Seeder
{
    public function run(): void
    {
        $manager = User::role('manager')->first();

        $venues = [
            [
                'name' => 'Sports Complex Mumbai',
                'description' => 'Premier sports facility with multiple courts and amenities',
                'address' => '123 Sports Street, Bandra West',
                'city' => 'Mumbai',
                'state' => 'Maharashtra',
                'postal_code' => '400050',
                'country' => 'India',
                'phone' => '+91-22-2645-6789',
                'email' => 'info@sportscomplexmumbai.com',
                'manager_id' => $manager->id,
                'is_active' => true,
            ],
            [
                'name' => 'Elite Sports Center',
                'description' => 'High-end sports facility with professional equipment',
                'address' => '456 Elite Road, Andheri East',
                'city' => 'Mumbai',
                'state' => 'Maharashtra',
                'postal_code' => '400069',
                'country' => 'India',
                'phone' => '+91-22-2856-7890',
                'email' => 'contact@elitesportscenter.com',
                'manager_id' => $manager->id,
                'is_active' => true,
            ],
        ];

        foreach ($venues as $venueData) {
            Venue::create($venueData);
        }
    }
}
