<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Facility;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_booking(): void
    {
        $user = User::factory()->create();
        $user->assignRole('player');
        
        $venue = Venue::factory()->create();
        $facility = Facility::factory()->create(['venue_id' => $venue->id]);

        $response = $this->actingAs($user)->post('/bookings', [
            'facility_id' => $facility->id,
            'start_time' => now()->addDay()->setHour(10)->format('Y-m-d H:i:s'),
            'end_time' => now()->addDay()->setHour(12)->format('Y-m-d H:i:s'),
            'notes' => 'Test booking',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('bookings', [
            'user_id' => $user->id,
            'facility_id' => $facility->id,
            'notes' => 'Test booking',
        ]);
    }

    public function test_user_cannot_book_overlapping_time(): void
    {
        $user = User::factory()->create();
        $user->assignRole('player');
        
        $venue = Venue::factory()->create();
        $facility = Facility::factory()->create(['venue_id' => $venue->id]);

        // Create first booking
        Booking::factory()->create([
            'facility_id' => $facility->id,
            'start_time' => now()->addDay()->setHour(10),
            'end_time' => now()->addDay()->setHour(12),
            'status' => 'confirmed',
        ]);

        // Try to book overlapping time
        $response = $this->actingAs($user)->post('/bookings', [
            'facility_id' => $facility->id,
            'start_time' => now()->addDay()->setHour(11)->format('Y-m-d H:i:s'),
            'end_time' => now()->addDay()->setHour(13)->format('Y-m-d H:i:s'),
        ]);

        $response->assertSessionHasErrors(['time']);
    }

    public function test_admin_can_create_booking_for_user(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        
        $user = User::factory()->create();
        $user->assignRole('player');
        
        $venue = Venue::factory()->create();
        $facility = Facility::factory()->create(['venue_id' => $venue->id]);

        $response = $this->actingAs($admin)->post('/admin/bookings', [
            'facility_id' => $facility->id,
            'user_id' => $user->id,
            'start_time' => now()->addDay()->setHour(10)->format('Y-m-d H:i:s'),
            'end_time' => now()->addDay()->setHour(12)->format('Y-m-d H:i:s'),
            'payment_status' => 'paid',
            'notes' => 'Admin created booking',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('bookings', [
            'user_id' => $user->id,
            'facility_id' => $facility->id,
            'created_by_admin' => true,
            'admin_id' => $admin->id,
            'payment_status' => 'paid',
        ]);
    }
}
