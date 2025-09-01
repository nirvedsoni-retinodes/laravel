<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Venue;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:manager');
    }

    public function index()
    {
        $venues = Venue::where('manager_id', auth()->id())->pluck('id');
        $facilities = Facility::whereIn('venue_id', $venues)->with('venue')->paginate(20);
        
        return view('facilities.index', compact('facilities'));
    }

    public function create()
    {
        $venues = Venue::where('manager_id', auth()->id())->get();
        
        return view('facilities.create', compact('venues'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'venue_id' => 'required|exists:venues,id',
            'sport_type' => 'required|string|max:100',
            'capacity' => 'required|integer|min:1',
            'hourly_rate' => 'required|numeric|min:0',
        ]);

        $facility = Facility::create([
            'name' => $request->name,
            'description' => $request->description,
            'venue_id' => $request->venue_id,
            'sport_type' => $request->sport_type,
            'capacity' => $request->capacity,
            'hourly_rate' => $request->hourly_rate,
            'is_active' => true,
        ]);

        return redirect()->route('facilities.index')
            ->with('success', 'Facility created successfully!');
    }

    public function show(Facility $facility)
    {
        $this->authorize('view', $facility);
        
        return view('facilities.show', compact('facility'));
    }

    public function edit(Facility $facility)
    {
        $this->authorize('update', $facility);
        
        $venues = Venue::where('manager_id', auth()->id())->get();
        
        return view('facilities.edit', compact('facility', 'venues'));
    }

    public function update(Request $request, Facility $facility)
    {
        $this->authorize('update', $facility);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'venue_id' => 'required|exists:venues,id',
            'sport_type' => 'required|string|max:100',
            'capacity' => 'required|integer|min:1',
            'hourly_rate' => 'required|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        $facility->update($request->all());

        return redirect()->route('facilities.index')
            ->with('success', 'Facility updated successfully!');
    }

    public function destroy(Facility $facility)
    {
        $this->authorize('delete', $facility);
        
        $facility->delete();

        return redirect()->route('facilities.index')
            ->with('success', 'Facility deleted successfully!');
    }
}
