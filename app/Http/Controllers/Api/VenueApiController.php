<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Venue;

class VenueApiController extends Controller
{
    public function index()
    {
        $venues = Venue::where('is_active', true)->get();
        
        return response()->json($venues);
    }

    public function show(Venue $venue)
    {
        if (!$venue->is_active) {
            return response()->json(['error' => 'Venue not found'], 404);
        }
        
        return response()->json($venue->load('facilities'));
    }
}
