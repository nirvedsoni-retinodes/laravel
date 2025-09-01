<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Facility;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class BookingFactory extends Factory
{
    public function definition(): array
    {
        $startTime = Carbon::now()->addDays(fake()->numberBetween(1, 30))->setHour(fake()->numberBetween(8, 18))->setMinute(0);
        $endTime = $startTime->copy()->addHours(fake()->numberBetween(1, 3));
        $totalHours = $startTime->diffInHours($endTime);
        
        return [
            'user_id' => User::factory(),
            'facility_id' => Facility::factory(),
            'start_time' => $startTime,
            'end_time' => $endTime,
            'total_hours' => $totalHours,
            'total_amount' => fake()->randomFloat(2, 200, 2000),
            'status' => fake()->randomElement(['pending', 'confirmed', 'cancelled', 'completed']),
            'payment_status' => fake()->randomElement(['pending', 'paid', 'failed', 'refunded']),
            'notes' => fake()->optional()->sentence(),
            'created_by_admin' => false,
            'admin_id' => null,
        ];
    }
}
