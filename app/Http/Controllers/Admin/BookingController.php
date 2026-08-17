<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Booking;

class BookingController extends Controller
{
    public function index()
    {
        $query = Booking::with(['user', 'vehicle']);
        
        if (auth()->user()->role === 'vendor') {
            $query->whereHas('vehicle', function($q) {
                $q->where('shop_id', auth()->user()->shop->id);
            });
        }
        
        $bookings = $query->latest()->paginate(15);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,completed,rejected,cancelled'
        ]);

        $booking->update(['status' => $request->status]);

        return back()->with('success', 'Booking status updated to ' . ucfirst($request->status));
    }
}
