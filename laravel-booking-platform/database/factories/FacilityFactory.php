<?php

namespace Database\Factories;

use App\Models\Venue;
use Illuminate\Database\Eloquent\Factories\Factory;

class FacilityFactory extends Factory
{
    public function definition(): array
    {
        $sportTypes = ['Tennis', 'Badminton', 'Basketball', 'Football', 'Cricket', 'Swimming', 'Gym'];
        
        return [
            'name' => fake()->randomElement($sportTypes) . ' Court ' . fake()->numberBetween(1, 5),
            'description' => fake()->sentence(),
            'venue_id' => Venue::factory(),
            'sport_type' => fake()->randomElement($sportTypes),
            'capacity' => fake()->numberBetween(2, 22),
            'hourly_rate' => fake()->randomFloat(2, 200, 2000),
            'is_active' => true,
        ];
    }
}
