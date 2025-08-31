<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Facility;
use App\Models\User;
use App\Services\BookingService;
use App\Services\RazorpayService;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    protected $bookingService;
    protected $razorpayService;
    protected $whatsappService;

    public function __construct(
        BookingService $bookingService,
        RazorpayService $razorpayService,
        WhatsAppService $whatsappService
    ) {
        $this->bookingService = $bookingService;
        $this->razorpayService = $razorpayService;
        $this->whatsappService = $whatsappService;
    }

    public function index()
    {
        $user = Auth::user();
        
        if ($user->hasRole('admin')) {
            $bookings = Booking::with(['user', 'facility.venue'])->latest()->paginate(20);
        } elseif ($user->hasRole('manager')) {
            $venues = $user->managedVenues()->pluck('id');
            $facilities = Facility::whereIn('venue_id', $venues)->pluck('id');
            $bookings = Booking::whereIn('facility_id', $facilities)
                ->with(['user', 'facility.venue'])
                ->latest()
                ->paginate(20);
        } else {
            $bookings = $user->bookings()->with(['facility.venue'])->latest()->paginate(20);
        }

        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $facilities = Facility::with('venue')->where('is_active', true)->get();
        $users = User::role('player')->get();
        
        return view('bookings.create', compact('facilities', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'facility_id' => 'required|exists:facilities,id',
            'user_id' => 'required|exists:users,id',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
            'notes' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            // Check availability
            if (!$this->bookingService->isAvailable($request->facility_id, $request->start_time, $request->end_time)) {
                return back()->withErrors(['time' => 'Selected time slot is not available.']);
            }

            // Create booking
            $booking = $this->bookingService->createBooking($request->all(), Auth::id());

            // Send WhatsApp notification
            $this->whatsappService->sendBookingConfirmation($booking);

            DB::commit();

            return redirect()->route('bookings.show', $booking)
                ->with('success', 'Booking created successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to create booking: ' . $e->getMessage()]);
        }
    }

    public function show(Booking $booking)
    {
        $this->authorize('view', $booking);
        
        return view('bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $this->authorize('update', $booking);
        
        $facilities = Facility::with('venue')->where('is_active', true)->get();
        $users = User::role('player')->get();
        
        return view('bookings.edit', compact('booking', 'facilities', 'users'));
    }

    public function update(Request $request, Booking $booking)
    {
        $this->authorize('update', $booking);
        
        $request->validate([
            'facility_id' => 'required|exists:facilities,id',
            'user_id' => 'required|exists:users,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'status' => 'required|in:pending,confirmed,cancelled,completed',
            'payment_status' => 'required|in:pending,paid,failed,refunded',
            'notes' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            // Check availability (excluding current booking)
            if (!$this->bookingService->isAvailable($request->facility_id, $request->start_time, $request->end_time, $booking->id)) {
                return back()->withErrors(['time' => 'Selected time slot is not available.']);
            }

            $booking->update($request->all());

            // Send WhatsApp notification for status change
            $this->whatsappService->sendStatusUpdate($booking);

            DB::commit();

            return redirect()->route('bookings.show', $booking)
                ->with('success', 'Booking updated successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to update booking: ' . $e->getMessage()]);
        }
    }

    public function destroy(Booking $booking)
    {
        $this->authorize('delete', $booking);
        
        $booking->delete();
        
        return redirect()->route('bookings.index')
            ->with('success', 'Booking deleted successfully!');
    }

    public function initiatePayment(Booking $booking)
    {
        $this->authorize('update', $booking);
        
        try {
            $order = $this->razorpayService->createOrder($booking);
            
            return response()->json([
                'order_id' => $order['id'],
                'amount' => $order['amount'],
                'currency' => $order['currency'],
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function paymentCallback(Request $request)
    {
        try {
            $booking = $this->razorpayService->verifyPayment($request->all());
            
            // Send WhatsApp notification
            $this->whatsappService->sendPaymentConfirmation($booking);
            
            return redirect()->route('bookings.show', $booking)
                ->with('success', 'Payment successful!');
                
        } catch (\Exception $e) {
            return redirect()->route('bookings.index')
                ->withErrors(['error' => 'Payment verification failed: ' . $e->getMessage()]);
        }
    }

    public function generateInvoice(Booking $booking)
    {
        $this->authorize('view', $booking);
        
        $pdf = \PDF::loadView('bookings.invoice', compact('booking'));
        
        return $pdf->download("invoice-{$booking->booking_code}.pdf");
    }
}
