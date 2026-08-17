@extends('layouts.admin')

@section('header', 'Vehicles')

@section('content')
<div class="mb-4 flex justify-between items-center">
    <h3 class="text-lg font-bold">Manage Vehicles</h3>
    <a href="{{ route('admin.vehicles.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Vehicle</a>
</div>

<div class="bg-white rounded-lg shadow-sm overflow-x-auto">
    <table class="w-full whitespace-nowrap">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Details</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price/Day</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse ($vehicles as $vehicle)
                <tr>
                    <td class="px-6 py-4">
                        @if($vehicle->image)
                            <img src="{{ asset('storage/' . $vehicle->image) }}" alt="{{ $vehicle->name }}" class="h-12 w-20 object-cover rounded">
                        @else
                            <div class="h-12 w-20 bg-gray-200 flex items-center justify-center rounded text-xs text-gray-500">No Image</div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-medium text-gray-900">{{ $vehicle->name }}</div>
                        <div class="text-sm text-gray-500">{{ $vehicle->brand }} {{ $vehicle->model }} ({{ $vehicle->year }})</div>
                        <div class="text-xs text-gray-400">Reg: {{ $vehicle->registration_number }}</div>
                    </td>
                    <td class="px-6 py-4">{{ $vehicle->category->name ?? 'N/A' }}</td>
                    <td class="px-6 py-4">₹{{ number_format($vehicle->price_per_day, 2) }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $vehicle->status === 'available' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $vehicle->status === 'booked' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $vehicle->status === 'rented' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $vehicle->status === 'maintenance' ? 'bg-red-100 text-red-800' : '' }}
                        ">
                            {{ ucfirst($vehicle->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right flex justify-end gap-2">
                        <a href="{{ route('admin.vehicles.edit', $vehicle) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <form action="{{ route('admin.vehicles.destroy', $vehicle) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">No vehicles found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4 border-t">
        {{ $vehicles->links() }}
    </div>
</div>
@endsection
