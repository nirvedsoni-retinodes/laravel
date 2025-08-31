<?php

namespace Database\Factories;

use App\Models\Facility;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScheduleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'facility_id' => Facility::factory(),
            'day_of_week' => fake()->numberBetween(0, 6),
            'open_time' => fake()->time('H:i:s', '06:00:00'),
            'close_time' => fake()->time('H:i:s', '22:00:00'),
            'is_active' => true,
        ];
    }
}
