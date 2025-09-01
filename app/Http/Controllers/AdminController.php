<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Facility;
use App\Models\User;
use App\Models\Venue;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->middleware('role:admin');
        $this->bookingService = $bookingService;
    }

    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_venues' => Venue::count(),
            'total_facilities' => Facility::count(),
            'total_bookings' => Booking::count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'confirmed_bookings' => Booking::where('status', 'confirmed')->count(),
            'total_revenue' => Booking::where('payment_status', 'paid')->sum('total_amount'),
        ];

        $recent_bookings = Booking::with(['user', 'facility.venue'])
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_bookings'));
    }

    public function createBooking()
    {
        $facilities = Facility::with('venue')->where('is_active', true)->get();
        $users = User::role('player')->get();
        
        return view('admin.bookings.create', compact('facilities', 'users'));
    }

    public function storeBooking(Request $request)
    {
        $request->validate([
            'facility_id' => 'required|exists:facilities,id',
            'user_id' => 'required|exists:users,id',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
            'notes' => 'nullable|string',
            'payment_status' => 'required|in:pending,paid',
        ]);

        try {
            $booking = $this->bookingService->createBooking($request->all(), Auth::id());
            
            $booking->update([
                'payment_status' => $request->payment_status,
                'status' => $request->payment_status === 'paid' ? 'confirmed' : 'pending',
            ]);

            return redirect()->route('admin.dashboard')
                ->with('success', 'Booking created successfully!');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create booking: ' . $e->getMessage()]);
        }
    }

    public function users()
    {
        $users = User::with('roles')->paginate(20);
        
        return view('admin.users.index', compact('users'));
    }

    public function reports()
    {
        $monthlyRevenue = Booking::where('payment_status', 'paid')
            ->whereYear('created_at', now()->year)
            ->selectRaw('MONTH(created_at) as month, SUM(total_amount) as revenue')
            ->groupBy('month')
            ->get();

        $topFacilities = Facility::withCount(['bookings' => function ($query) {
            $query->where('payment_status', 'paid');
        }])
        ->orderBy('bookings_count', 'desc')
        ->take(5)
        ->get();

        return view('admin.reports.index', compact('monthlyRevenue', 'topFacilities'));
    }
}
