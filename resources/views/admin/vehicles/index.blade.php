@extends('layouts.admin')

@section('header', 'Vehicles')

@section('content')
<div class="mb-4 flex justify-between items-center">
    <h3 class="text-lg font-bold dark:text-yellow-400">Manage Vehicles</h3>
    <a href="{{ route('admin.vehicles.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Vehicle</a>
</div>

<div class="bg-white dark:bg-[#111111] rounded-lg shadow-sm overflow-x-auto border dark:border-yellow-900/50">
    <table class="w-full whitespace-nowrap">
        <thead class="bg-white dark:bg-black/50 border-b dark:border-yellow-900/50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-blue-600 dark:text-blue-500 uppercase tracking-wider">Image</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-blue-600 dark:text-blue-500 uppercase tracking-wider">Details</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-blue-600 dark:text-blue-500 uppercase tracking-wider">Category</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-blue-600 dark:text-blue-500 uppercase tracking-wider">Price/Day</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-blue-600 dark:text-blue-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-blue-600 dark:text-blue-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse ($vehicles as $vehicle)
                <tr class="hover:bg-white dark:hover:bg-gray-700/50">
                    <td class="px-6 py-4">
                        @if($vehicle->image)
                            <img src="{{ asset('storage/' . $vehicle->image) }}" alt="{{ $vehicle->name }}" class="h-12 w-20 object-cover rounded">
                        @else
                            <div class="h-12 w-20 bg-gray-200 dark:bg-gray-700 flex items-center justify-center rounded text-xs text-blue-600 dark:text-blue-500">No Image</div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-medium text-blue-950 dark:text-yellow-400">{{ $vehicle->name }}</div>
                        <div class="text-sm text-blue-600 dark:text-blue-500">{{ $vehicle->brand }} {{ $vehicle->model }} ({{ $vehicle->year }})</div>
                        <div class="text-xs text-blue-500 dark:text-blue-600">Reg: {{ $vehicle->registration_number }}</div>
                    </td>
                    <td class="px-6 py-4 dark:text-yellow-500">{{ $vehicle->category->name ?? 'N/A' }}</td>
                    <td class="px-6 py-4 dark:text-yellow-500">₹{{ number_format($vehicle->price_per_day, 2) }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $vehicle->status === 'available' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : '' }}
                            {{ $vehicle->status === 'booked' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400' : '' }}
                            {{ $vehicle->status === 'rented' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' : '' }}
                            {{ $vehicle->status === 'maintenance' ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' : '' }}
                        ">
                            {{ ucfirst($vehicle->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right flex justify-end gap-2">
                        <a href="{{ route('admin.vehicles.edit', $vehicle) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300" title="Edit">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </a>
                        <form action="{{ route('admin.vehicles.destroy', $vehicle) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300" title="Delete">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-blue-600 dark:text-blue-500">No vehicles found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4 border-t dark:border-yellow-900/50">
        {{ $vehicles->links() }}
    </div>
</div>
@endsection
