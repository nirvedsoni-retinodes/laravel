<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\Facility;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $facilities = Facility::all();

        foreach ($facilities as $facility) {
            // Create schedules for all days of the week
            for ($day = 0; $day < 7; $day++) {
                Schedule::create([
                    'facility_id' => $facility->id,
                    'day_of_week' => $day,
                    'open_time' => '06:00:00',
                    'close_time' => '22:00:00',
                    'is_active' => true,
                ]);
            }
        }
    }
}
