@extends('layouts.admin')

@section('header', 'Dashboard Overview')

@section('content')
<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Vehicles -->
    <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-blue-100 dark:border-slate-800 p-6 flex items-center">
        <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900/50 text-blue-600 dark:text-blue-400 mr-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
        </div>
        <div>
            <p class="text-sm font-medium text-blue-600 dark:text-blue-500">Total Vehicles</p>
            <p class="text-3xl font-bold text-blue-950 dark:text-slate-100">{{ $stats['total_vehicles'] }}</p>
        </div>
    </div>
    
    <!-- Available Vehicles -->
    <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-blue-100 dark:border-slate-800 p-6 flex items-center">
        <div class="p-3 rounded-full bg-green-100 dark:bg-green-900/50 text-green-600 dark:text-green-400 mr-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <div>
            <p class="text-sm font-medium text-blue-600 dark:text-blue-500">Available Vehicles</p>
            <p class="text-3xl font-bold text-blue-950 dark:text-slate-100">{{ $stats['available_vehicles'] }}</p>
        </div>
    </div>
    
    <!-- Pending Bookings -->
    <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-blue-100 dark:border-slate-800 p-6 flex items-center">
        <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900/50 text-yellow-600 dark:text-slate-100 mr-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <div>
            <p class="text-sm font-medium text-blue-600 dark:text-blue-500">Pending Bookings</p>
            <p class="text-3xl font-bold text-blue-950 dark:text-slate-100">{{ $stats['pending_bookings'] }}</p>
        </div>
    </div>
    
    <!-- Total Customers -->
    <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-blue-100 dark:border-slate-800 p-6 flex items-center">
        <div class="p-3 rounded-full bg-indigo-100 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400 mr-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
        </div>
        <div>
            <p class="text-sm font-medium text-blue-600 dark:text-blue-500">Total Customers</p>
            <p class="text-3xl font-bold text-blue-950 dark:text-slate-100">{{ $stats['total_customers'] }}</p>
        </div>
    </div>
</div>

<!-- Recent Bookings Table -->
<div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-blue-100 dark:border-slate-800 overflow-hidden">
    <div class="px-6 py-5 border-b border-blue-100 dark:border-slate-800 flex justify-between items-center bg-white/50 dark:bg-slate-900/50">
        <h3 class="text-lg font-bold text-blue-900 dark:text-slate-100">Recent Bookings</h3>
        <a href="{{ route('admin.bookings.index') }}" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">View All</a>
    </div>
    
    @if($stats['recent_bookings']->isEmpty())
        <div class="p-8 text-center">
            <svg class="mx-auto h-12 w-12 text-blue-500 dark:text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-blue-950 dark:text-slate-100">No bookings</h3>
            <p class="mt-1 text-sm text-blue-600 dark:text-blue-500">No recent rental bookings found.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left whitespace-nowrap">
                <thead>
                    <tr class="bg-white dark:bg-slate-900 border-b border-blue-100 dark:border-slate-800 text-xs font-semibold text-blue-600 dark:text-blue-500 uppercase tracking-wider">
                        <th class="px-6 py-4">Booking ID</th>
                        <th class="px-6 py-4">Customer</th>
                        <th class="px-6 py-4">Vehicle</th>
                        <th class="px-6 py-4">Rental Period</th>
                        <th class="px-6 py-4 text-right">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                    @foreach($stats['recent_bookings'] as $booking)
                        <tr class="hover:bg-white/50 dark:hover:bg-gray-700/50 transition-colors">
                            <td class="px-6 py-4 text-sm font-medium text-indigo-600 dark:text-indigo-400">
                                <a href="{{ route('admin.bookings.index') }}">#{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</a>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-blue-950 dark:text-slate-100">{{ $booking->user->name }}</div>
                                <div class="text-xs text-blue-600 dark:text-blue-500">{{ $booking->user->email }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-blue-950 dark:text-slate-100">{{ $booking->vehicle->name }}</div>
                                <div class="text-xs text-blue-600 dark:text-blue-500">{{ $booking->vehicle->registration_number }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-blue-800 dark:text-slate-300">
                                {{ $booking->start_date->format('M d') }} - {{ $booking->end_date->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 text-right text-sm">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $booking->status === 'pending' ? 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-slate-100' : '' }}
                                    {{ $booking->status === 'approved' ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-400' : '' }}
                                    {{ $booking->status === 'completed' ? 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400' : '' }}
                                    {{ $booking->status === 'rejected' ? 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-400' : '' }}
                                    {{ $booking->status === 'cancelled' ? 'bg-blue-50 dark:bg-gray-700 text-blue-900 dark:text-gray-200' : '' }}
                                ">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
