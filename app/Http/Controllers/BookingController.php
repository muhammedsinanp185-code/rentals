<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Booking;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $user = Auth::user();
        $bookings = $user->bookings()->with('vehicle')->latest()->paginate(10);
        
        $stats = [
            'total_bookings' => $user->bookings()->count(),
            'active_bookings' => $user->bookings()->whereIn('status', ['pending', 'approved'])->count(),
            'total_spent' => $user->bookings()->where('status', 'completed')->sum('total_amount'),
        ];

        return view('bookings.index', compact('bookings', 'stats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $vehicle = Vehicle::findOrFail($request->vehicle_id);

        if ($vehicle->status === 'maintenance') {
            return back()->with('error', 'This vehicle is currently under maintenance.');
        }

        $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date);
        
        $overlapping = Booking::where('vehicle_id', $vehicle->id)
            ->whereIn('status', ['pending', 'approved', 'completed']) 
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('start_date', [$start, $end])
                      ->orWhereBetween('end_date', [$start, $end])
                      ->orWhere(function ($q) use ($start, $end) {
                          $q->where('start_date', '<=', $start)
                            ->where('end_date', '>=', $end);
                      });
            })->exists();

        if ($overlapping) {
            return back()->with('error', 'The vehicle is already booked for the selected dates.');
        }

        $totalDays = $start->diffInDays($end) + 1;
        $totalAmount = $totalDays * $vehicle->price_per_day;

        Booking::create([
            'user_id' => Auth::id(),
            'vehicle_id' => $vehicle->id,
            'start_date' => $start,
            'end_date' => $end,
            'total_days' => $totalDays,
            'price_per_day' => $vehicle->price_per_day,
            'total_amount' => $totalAmount,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Booking requested successfully! Waiting for admin approval.');
    }

    public function cancel(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        if ($booking->status !== 'pending') {
            return back()->with('error', 'Only pending bookings can be cancelled.');
        }

        $booking->update(['status' => 'cancelled']);

        return back()->with('success', 'Booking cancelled successfully.');
    }
}
