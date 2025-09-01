<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Facility;
use App\Models\Venue;

class FacilitySeeder extends Seeder
{
    public function run(): void
    {
        $venues = Venue::all();

        foreach ($venues as $venue) {
            $facilities = [
                [
                    'name' => 'Tennis Court 1',
                    'description' => 'Professional tennis court with synthetic surface',
                    'venue_id' => $venue->id,
                    'sport_type' => 'Tennis',
                    'capacity' => 4,
                    'hourly_rate' => 800.00,
                    'is_active' => true,
                ],
                [
                    'name' => 'Tennis Court 2',
                    'description' => 'Professional tennis court with synthetic surface',
                    'venue_id' => $venue->id,
                    'sport_type' => 'Tennis',
                    'capacity' => 4,
                    'hourly_rate' => 800.00,
                    'is_active' => true,
                ],
                [
                    'name' => 'Badminton Court 1',
                    'description' => 'Professional badminton court with wooden flooring',
                    'venue_id' => $venue->id,
                    'sport_type' => 'Badminton',
                    'capacity' => 4,
                    'hourly_rate' => 500.00,
                    'is_active' => true,
                ],
                [
                    'name' => 'Badminton Court 2',
                    'description' => 'Professional badminton court with wooden flooring',
                    'venue_id' => $venue->id,
                    'sport_type' => 'Badminton',
                    'capacity' => 4,
                    'hourly_rate' => 500.00,
                    'is_active' => true,
                ],
                [
                    'name' => 'Basketball Court',
                    'description' => 'Full-size basketball court with professional hoops',
                    'venue_id' => $venue->id,
                    'sport_type' => 'Basketball',
                    'capacity' => 10,
                    'hourly_rate' => 1200.00,
                    'is_active' => true,
                ],
                [
                    'name' => 'Football Ground',
                    'description' => 'Professional football ground with natural grass',
                    'venue_id' => $venue->id,
                    'sport_type' => 'Football',
                    'capacity' => 22,
                    'hourly_rate' => 2000.00,
                    'is_active' => true,
                ],
            ];

            foreach ($facilities as $facilityData) {
                Facility::create($facilityData);
            }
        }
    }
}
