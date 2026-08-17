@extends('layouts.admin')

@section('header', 'Bookings')

@section('content')
<div class="mb-4 flex justify-between items-center">
    <h3 class="text-lg font-bold">Manage Bookings</h3>
</div>

<div class="bg-white rounded-lg shadow-sm overflow-x-auto">
    <table class="w-full whitespace-nowrap">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vehicle</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dates</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse ($bookings as $booking)
                <tr>
                    <td class="px-6 py-4">#{{ $booking->id }}</td>
                    <td class="px-6 py-4">
                        <div class="font-medium text-gray-900">{{ $booking->user->name }}</div>
                        <div class="text-xs text-gray-500">{{ $booking->user->email }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-medium text-gray-900">{{ $booking->vehicle->name }}</div>
                        <div class="text-xs text-gray-500">{{ $booking->vehicle->registration_number }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">{{ $booking->start_date->format('d M Y') }}</div>
                        <div class="text-xs text-gray-500">to {{ $booking->end_date->format('d M Y') }} ({{ $booking->total_days }}d)</div>
                    </td>
                    <td class="px-6 py-4 font-bold">₹{{ number_format($booking->total_amount, 0) }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $booking->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $booking->status === 'approved' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $booking->status === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $booking->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}
                            {{ $booking->status === 'cancelled' ? 'bg-gray-100 text-gray-800' : '' }}
                        ">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <form action="{{ route('admin.bookings.update-status', $booking) }}" method="POST" class="flex justify-end items-center gap-2">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="text-sm rounded border-gray-300 py-1 pr-8" onchange="this.form.submit()">
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
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">No bookings found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4 border-t">
        {{ $bookings->links() }}
    </div>
</div>
@endsection
