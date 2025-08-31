<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Facility;
use App\Models\User;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $facilities = Facility::all();
        $players = User::role('player')->get();
        $admin = User::role('admin')->first();

        // Create sample bookings for the next 7 days
        for ($i = 0; $i < 10; $i++) {
            $facility = $facilities->random();
            $player = $players->random();
            
            $startTime = Carbon::now()->addDays(rand(1, 7))->setHour(rand(8, 18))->setMinute(0);
            $endTime = $startTime->copy()->addHours(rand(1, 3));
            $totalHours = $startTime->diffInHours($endTime);
            $totalAmount = $facility->hourly_rate * $totalHours;

            $status = ['pending', 'confirmed', 'completed'][rand(0, 2)];
            $paymentStatus = $status === 'completed' ? 'paid' : 'pending';

            Booking::create([
                'user_id' => $player->id,
                'facility_id' => $facility->id,
                'start_time' => $startTime,
                'end_time' => $endTime,
                'total_hours' => $totalHours,
                'total_amount' => $totalAmount,
                'status' => $status,
                'payment_status' => $paymentStatus,
                'notes' => 'Sample booking for demonstration',
                'created_by_admin' => false,
            ]);
        }

        // Create some admin-created bookings
        for ($i = 0; $i < 3; $i++) {
            $facility = $facilities->random();
            $player = $players->random();
            
            $startTime = Carbon::now()->addDays(rand(1, 7))->setHour(rand(8, 18))->setMinute(0);
            $endTime = $startTime->copy()->addHours(rand(1, 3));
            $totalHours = $startTime->diffInHours($endTime);
            $totalAmount = $facility->hourly_rate * $totalHours;

            Booking::create([
                'user_id' => $player->id,
                'facility_id' => $facility->id,
                'start_time' => $startTime,
                'end_time' => $endTime,
                'total_hours' => $totalHours,
                'total_amount' => $totalAmount,
                'status' => 'confirmed',
                'payment_status' => 'paid',
                'notes' => 'Admin created booking',
                'created_by_admin' => true,
                'admin_id' => $admin->id,
            ]);
        }
    }
}
