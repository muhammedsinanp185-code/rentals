@extends('layouts.customer')

@section('header', 'My Dashboard')

@section('content')

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
    <!-- Total Bookings -->
    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-blue-100 dark:border-slate-800 p-6 flex items-center transition-transform hover:scale-[1.02]">
        <div class="p-4 rounded-full bg-blue-50 dark:bg-zinc-800 text-blue-950 dark:text-slate-100 mr-5">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        </div>
        <div>
            <p class="text-xs font-semibold text-blue-500 uppercase tracking-widest mb-1">Total Bookings</p>
            <p class="text-3xl font-extrabold text-blue-950 dark:text-slate-100">{{ $stats['total_bookings'] }}</p>
        </div>
    </div>
    
    <!-- Active Bookings -->
    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-blue-100 dark:border-slate-800 p-6 flex items-center transition-transform hover:scale-[1.02]">
        <div class="p-4 rounded-full bg-blue-50 dark:bg-zinc-800 text-blue-950 dark:text-slate-100 mr-5">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <div>
            <p class="text-xs font-semibold text-blue-500 uppercase tracking-widest mb-1">Active Bookings</p>
            <p class="text-3xl font-extrabold text-blue-950 dark:text-slate-100">{{ $stats['active_bookings'] }}</p>
        </div>
    </div>
    
    <!-- Total Spent -->
    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-blue-100 dark:border-slate-800 p-6 flex items-center transition-transform hover:scale-[1.02]">
        <div class="p-4 rounded-full bg-blue-50 dark:bg-zinc-800 text-blue-950 dark:text-slate-100 mr-5">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <div>
            <p class="text-xs font-semibold text-blue-500 uppercase tracking-widest mb-1">Total Spent</p>
            <p class="text-3xl font-extrabold text-blue-950 dark:text-slate-100">₹{{ number_format($stats['total_spent'], 0) }}</p>
        </div>
    </div>
</div>

<div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-blue-100 dark:border-slate-800 overflow-hidden">
    <div class="px-8 py-6 border-b border-blue-100 dark:border-slate-800 flex justify-between items-center bg-white/30 dark:bg-slate-900/50">
        <h3 class="text-xl font-bold text-blue-950 dark:text-slate-100">Booking History</h3>
        <a href="{{ route('vehicles.index') }}" class="inline-flex items-center px-5 py-2.5 bg-slate-900 dark:bg-white text-white dark:text-blue-950 rounded-full font-bold text-xs uppercase tracking-widest hover:opacity-80 transition-opacity">
            Book New Vehicle
        </a>
    </div>

    @if($bookings->isEmpty())
        <div class="p-12 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-300 dark:text-zinc-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
            <h3 class="mt-2 text-sm font-bold text-blue-950 dark:text-slate-100 uppercase tracking-wider">No bookings yet</h3>
            <p class="mt-1 text-sm text-blue-600 dark:text-blue-500">You haven't rented any vehicles. Get started by exploring our catalog.</p>
            <div class="mt-6">
                <a href="{{ route('vehicles.index') }}" class="inline-flex items-center px-5 py-2.5 bg-slate-900 dark:bg-white text-white dark:text-blue-950 rounded-full font-bold text-xs uppercase tracking-widest hover:opacity-80 transition-opacity">
                    Browse Vehicles
                </a>
            </div>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left whitespace-nowrap">
                <thead class="bg-white dark:bg-slate-900 border-b border-blue-100 dark:border-slate-800">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-blue-500 dark:text-blue-600 uppercase tracking-widest">Booking ID</th>
                        <th class="px-6 py-4 text-xs font-bold text-blue-500 dark:text-blue-600 uppercase tracking-widest">Vehicle</th>
                        <th class="px-6 py-4 text-xs font-bold text-blue-500 dark:text-blue-600 uppercase tracking-widest">Dates</th>
                        <th class="px-6 py-4 text-xs font-bold text-blue-500 dark:text-blue-600 uppercase tracking-widest">Amount</th>
                        <th class="px-6 py-4 text-xs font-bold text-blue-500 dark:text-blue-600 uppercase tracking-widest">Status</th>
                        <th class="px-6 py-4 text-xs font-bold text-blue-500 dark:text-blue-600 uppercase tracking-widest">Payment Info</th>
                        <th class="px-6 py-4 text-xs font-bold text-blue-500 dark:text-blue-600 uppercase tracking-widest text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-blue-50 dark:divide-slate-800">
                    @foreach($bookings as $booking)
                        <tr class="hover:bg-blue-50/50 dark:hover:bg-slate-800/50 transition-colors">
                            <td class="px-6 py-4 text-sm font-bold text-blue-950 dark:text-slate-100">#{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-bold text-blue-950 dark:text-slate-100">{{ $booking->vehicle->name }}</div>
                                <div class="text-xs text-blue-600 dark:text-blue-500 font-medium">{{ $booking->vehicle->brand }} | Shop: {{ $booking->vehicle->shop->name ?? 'Unknown' }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-blue-800 dark:text-slate-300">
                                {{ $booking->start_date->format('M d, Y') }} <br>
                                <span class="text-xs text-blue-500 dark:text-blue-600 font-normal">to</span> {{ $booking->end_date->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-extrabold text-blue-950 dark:text-slate-100">₹{{ number_format($booking->total_amount, 0) }}</div>
                                <div class="text-xs text-blue-600 dark:text-blue-500 font-medium">{{ $booking->total_days }} days</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest 
                                    {{ $booking->status === 'pending' ? 'bg-blue-50 dark:bg-zinc-800 text-zinc-800 dark:text-zinc-300 border border-zinc-200 dark:border-zinc-700' : '' }}
                                    {{ $booking->status === 'approved' ? 'bg-slate-900 dark:bg-white text-white dark:text-blue-950' : '' }}
                                    {{ $booking->status === 'completed' ? 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400' : '' }}
                                    {{ $booking->status === 'rejected' ? 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-400' : '' }}
                                    {{ $booking->status === 'cancelled' ? 'bg-blue-50 dark:bg-slate-900 text-blue-600 dark:text-blue-500' : '' }}
                                ">
                                    {{ $booking->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($booking->vehicle->shop && $booking->vehicle->shop->payment_instructions)
                                    <div class="text-xs text-blue-800 dark:text-slate-300 whitespace-normal max-w-xs p-3 bg-white dark:bg-zinc-800/50 rounded-md border border-blue-100 dark:border-zinc-700 font-medium">
                                        <strong class="block mb-1 text-blue-950 dark:text-slate-100 text-[10px] uppercase tracking-widest">Payment Instructions:</strong>
                                        {{ Str::limit($booking->vehicle->shop->payment_instructions, 100) }}
                                    </div>
                                @else
                                    <span class="text-xs text-blue-500 font-medium">Pay at shop</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                @if($booking->status === 'pending')
                                    <form action="{{ route('bookings.cancel', $booking) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                                        @csrf
                                        <button type="submit" class="text-zinc-400 hover:text-red-600 dark:hover:text-red-400 text-sm font-bold uppercase tracking-widest transition-colors">Cancel</button>
                                    </form>
                                @else
                                    <span class="text-gray-300 dark:text-zinc-700 text-sm">-</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($bookings->hasPages())
            <div class="px-8 py-5 border-t border-blue-100 dark:border-slate-800 bg-white/30 dark:bg-slate-900/30">
                {{ $bookings->links() }}
            </div>
        @endif
    @endif
</div>
@endsection
