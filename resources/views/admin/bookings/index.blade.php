@extends('layouts.admin')

@section('header', 'Bookings')

@section('content')
<div class="mb-4 flex justify-between items-center">
    <h3 class="text-lg font-bold dark:text-slate-100">Manage Bookings</h3>
</div>

<div class="bg-white dark:bg-slate-900 rounded-lg shadow-sm overflow-x-auto border dark:border-slate-800">
    <table class="w-full whitespace-nowrap">
        <thead class="bg-white dark:bg-slate-950/50 border-b dark:border-slate-800">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-blue-600 dark:text-blue-500 uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-blue-600 dark:text-blue-500 uppercase tracking-wider">Customer</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-blue-600 dark:text-blue-500 uppercase tracking-wider">Vehicle</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-blue-600 dark:text-blue-500 uppercase tracking-wider">Dates</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-blue-600 dark:text-blue-500 uppercase tracking-wider">Amount</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-blue-600 dark:text-blue-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-blue-600 dark:text-blue-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse ($bookings as $booking)
                <tr class="hover:bg-white dark:hover:bg-gray-700/50">
                    <td class="px-6 py-4 dark:text-slate-300">#{{ $booking->id }}</td>
                    <td class="px-6 py-4">
                        <div class="font-medium text-blue-950 dark:text-slate-100">{{ $booking->user->name }}</div>
                        <div class="text-xs text-blue-600 dark:text-blue-500">{{ $booking->user->email }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-medium text-blue-950 dark:text-slate-100">{{ $booking->vehicle->name }}</div>
                        <div class="text-xs text-blue-600 dark:text-blue-500">{{ $booking->vehicle->registration_number }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-blue-950 dark:text-slate-100">{{ $booking->start_date->format('d M Y') }}</div>
                        <div class="text-xs text-blue-600 dark:text-blue-500">to {{ $booking->end_date->format('d M Y') }} ({{ $booking->total_days }}d)</div>
                    </td>
                    <td class="px-6 py-4 font-bold dark:text-slate-100">₹{{ number_format($booking->total_amount, 0) }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $booking->status === 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-slate-100' : '' }}
                            {{ $booking->status === 'approved' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' : '' }}
                            {{ $booking->status === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : '' }}
                            {{ $booking->status === 'rejected' ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' : '' }}
                            {{ $booking->status === 'cancelled' ? 'bg-blue-50 text-blue-900 dark:bg-gray-700 dark:text-gray-200' : '' }}
                        ">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <form action="{{ route('admin.bookings.update-status', $booking) }}" method="POST" class="flex justify-end items-center gap-2">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="text-sm rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-slate-100 py-1 pr-8" onchange="this.form.submit()">
                                <option value="pending" {{ $booking->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ $booking->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="completed" {{ $booking->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="rejected" {{ $booking->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                <option value="cancelled" {{ $booking->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-blue-600 dark:text-blue-500">No bookings found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4 border-t dark:border-slate-800">
        {{ $bookings->links() }}
    </div>
</div>
@endsection
