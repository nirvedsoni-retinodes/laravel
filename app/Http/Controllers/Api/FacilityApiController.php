<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Services\BookingService;

class FacilityApiController extends Controller
{
    public function index()
    {
        $facilities = Facility::where('is_active', true)->with('venue')->get();
        
        return response()->json($facilities);
    }

    public function show(Facility $facility)
    {
        if (!$facility->is_active) {
            return response()->json(['error' => 'Facility not found'], 404);
        }
        
        return response()->json($facility->load(['venue', 'schedules']));
    }

    public function availability(Facility $facility, Request $request)
    {
        $request->validate([
            'date' => 'required|date|after:today',
        ]);

        $slots = app(BookingService::class)->getAvailableSlots($facility->id, $request->date);
        
        return response()->json($slots);
    }
}
