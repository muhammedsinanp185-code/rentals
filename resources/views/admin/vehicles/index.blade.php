@extends('layouts.admin')

@section('header', 'Vehicles')

@section('content')
<div class="mb-4 flex justify-between items-center">
    <h3 class="text-lg font-bold dark:text-white">Manage Vehicles</h3>
    <a href="{{ route('admin.vehicles.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Vehicle</a>
</div>

<div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-x-auto border dark:border-gray-700">
    <table class="w-full whitespace-nowrap">
        <thead class="bg-gray-50 dark:bg-gray-900/50 border-b dark:border-gray-700">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Image</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Details</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Category</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Price/Day</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse ($vehicles as $vehicle)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                    <td class="px-6 py-4">
                        @if($vehicle->image)
                            <img src="{{ asset('storage/' . $vehicle->image) }}" alt="{{ $vehicle->name }}" class="h-12 w-20 object-cover rounded">
                        @else
                            <div class="h-12 w-20 bg-gray-200 dark:bg-gray-700 flex items-center justify-center rounded text-xs text-gray-500 dark:text-gray-400">No Image</div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-medium text-gray-900 dark:text-white">{{ $vehicle->name }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $vehicle->brand }} {{ $vehicle->model }} ({{ $vehicle->year }})</div>
                        <div class="text-xs text-gray-400 dark:text-gray-500">Reg: {{ $vehicle->registration_number }}</div>
                    </td>
                    <td class="px-6 py-4 dark:text-gray-300">{{ $vehicle->category->name ?? 'N/A' }}</td>
                    <td class="px-6 py-4 dark:text-gray-300">₹{{ number_format($vehicle->price_per_day, 2) }}</td>
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
                        <a href="{{ route('admin.vehicles.edit', $vehicle) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300">Edit</a>
                        <form action="{{ route('admin.vehicles.destroy', $vehicle) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">No vehicles found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4 border-t dark:border-gray-700">
        {{ $vehicles->links() }}
    </div>
</div>
@endsection
