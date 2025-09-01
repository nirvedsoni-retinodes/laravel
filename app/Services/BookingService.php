<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Facility;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BookingService
{
    /**
     * Check if a facility is available for the given time slot
     * This method implements atomic booking logic to prevent overlapping bookings
     */
    public function isAvailable(int $facilityId, string $startTime, string $endTime, ?int $excludeBookingId = null): bool
    {
        $start = Carbon::parse($startTime);
        $end = Carbon::parse($endTime);

        // Check if the time is within facility operating hours
        if (!$this->isWithinOperatingHours($facilityId, $start, $end)) {
            return false;
        }

        // Check for overlapping bookings using database-level constraints
        $query = Booking::where('facility_id', $facilityId)
            ->where('status', '!=', 'cancelled')
            ->where(function ($q) use ($start, $end) {
                $q->where(function ($q) use ($start, $end) {
                    $q->where('start_time', '<', $end)
                      ->where('end_time', '>', $start);
                });
            });

        if ($excludeBookingId) {
            $query->where('id', '!=', $excludeBookingId);
        }

        return !$query->exists();
    }

    /**
     * Create a new booking with atomic operation
     */
    public function createBooking(array $data, int $adminId = null): Booking
    {
        return DB::transaction(function () use ($data, $adminId) {
            $facility = Facility::findOrFail($data['facility_id']);
            
            $startTime = Carbon::parse($data['start_time']);
            $endTime = Carbon::parse($data['end_time']);
            $totalHours = $startTime->diffInHours($endTime);
            $totalAmount = $facility->hourly_rate * $totalHours;

            // Double-check availability within transaction
            if (!$this->isAvailable($data['facility_id'], $data['start_time'], $data['end_time'])) {
                throw new \Exception('Facility is no longer available for the selected time slot.');
            }

            $bookingData = [
                'user_id' => $data['user_id'],
                'facility_id' => $data['facility_id'],
                'start_time' => $startTime,
                'end_time' => $endTime,
                'total_hours' => $totalHours,
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'payment_status' => 'pending',
                'notes' => $data['notes'] ?? null,
                'created_by_admin' => !is_null($adminId),
                'admin_id' => $adminId,
            ];

            return Booking::create($bookingData);
        });
    }

    /**
     * Check if the requested time is within facility operating hours
     */
    private function isWithinOperatingHours(int $facilityId, Carbon $start, Carbon $end): bool
    {
        $facility = Facility::with('schedules')->find($facilityId);
        
        if (!$facility) {
            return false;
        }

        foreach ($facility->schedules as $schedule) {
            if ($schedule->day_of_week == $start->dayOfWeek && $schedule->is_active) {
                $openTime = Carbon::parse($schedule->open_time);
                $closeTime = Carbon::parse($schedule->close_time);
                
                $startTime = $start->format('H:i:s');
                $endTime = $end->format('H:i:s');
                
                return $startTime >= $openTime->format('H:i:s') && $endTime <= $closeTime->format('H:i:s');
            }
        }

        return false;
    }

    /**
     * Get available time slots for a facility on a specific date
     */
    public function getAvailableSlots(int $facilityId, string $date): array
    {
        $facility = Facility::with('schedules')->find($facilityId);
        
        if (!$facility) {
            return [];
        }

        $dateObj = Carbon::parse($date);
        $dayOfWeek = $dateObj->dayOfWeek;
        
        $schedule = $facility->schedules->where('day_of_week', $dayOfWeek)->first();
        
        if (!$schedule || !$schedule->is_active) {
            return [];
        }

        $openTime = Carbon::parse($schedule->open_time);
        $closeTime = Carbon::parse($schedule->close_time);
        
        $slots = [];
        $currentTime = $openTime->copy();
        
        while ($currentTime < $closeTime) {
            $slotStart = $dateObj->copy()->setTime($currentTime->hour, $currentTime->minute);
            $slotEnd = $slotStart->copy()->addHour();
            
            if ($this->isAvailable($facilityId, $slotStart, $slotEnd)) {
                $slots[] = [
                    'start' => $slotStart->format('H:i'),
                    'end' => $slotEnd->format('H:i'),
                ];
            }
            
            $currentTime->addHour();
        }

        return $slots;
    }
}
