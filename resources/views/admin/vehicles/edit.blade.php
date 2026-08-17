@extends('layouts.admin')

@section('header', 'Edit Vehicle')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <form action="{{ route('admin.vehicles.update', $vehicle) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $vehicle->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Category -->
            <div>
                <label for="vehicle_category_id" class="block text-sm font-medium text-gray-700">Category</label>
                <select name="vehicle_category_id" id="vehicle_category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('vehicle_category_id', $vehicle->vehicle_category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('vehicle_category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Brand -->
            <div>
                <label for="brand" class="block text-sm font-medium text-gray-700">Brand</label>
                <input type="text" name="brand" id="brand" value="{{ old('brand', $vehicle->brand) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                @error('brand') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Model -->
            <div>
                <label for="model" class="block text-sm font-medium text-gray-700">Model</label>
                <input type="text" name="model" id="model" value="{{ old('model', $vehicle->model) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                @error('model') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Year -->
            <div>
                <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
                <input type="number" name="year" id="year" value="{{ old('year', $vehicle->year) }}" min="1900" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                @error('year') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Registration Number -->
            <div>
                <label for="registration_number" class="block text-sm font-medium text-gray-700">Registration Number</label>
                <input type="text" name="registration_number" id="registration_number" value="{{ old('registration_number', $vehicle->registration_number) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                @error('registration_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Price Per Day -->
            <div>
                <label for="price_per_day" class="block text-sm font-medium text-gray-700">Price Per Day (₹)</label>
                <input type="number" step="0.01" name="price_per_day" id="price_per_day" value="{{ old('price_per_day', $vehicle->price_per_day) }}" min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                @error('price_per_day') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Seats -->
            <div>
                <label for="seats" class="block text-sm font-medium text-gray-700">Seats</label>
                <input type="number" name="seats" id="seats" value="{{ old('seats', $vehicle->seats) }}" min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                @error('seats') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Fuel Type -->
            <div>
                <label for="fuel_type" class="block text-sm font-medium text-gray-700">Fuel Type</label>
                <select name="fuel_type" id="fuel_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    <option value="Petrol" {{ old('fuel_type', $vehicle->fuel_type) == 'Petrol' ? 'selected' : '' }}>Petrol</option>
                    <option value="Diesel" {{ old('fuel_type', $vehicle->fuel_type) == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                    <option value="Electric" {{ old('fuel_type', $vehicle->fuel_type) == 'Electric' ? 'selected' : '' }}>Electric</option>
                    <option value="Hybrid" {{ old('fuel_type', $vehicle->fuel_type) == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                </select>
                @error('fuel_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Transmission -->
            <div>
                <label for="transmission" class="block text-sm font-medium text-gray-700">Transmission</label>
                <select name="transmission" id="transmission" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    <option value="Manual" {{ old('transmission', $vehicle->transmission) == 'Manual' ? 'selected' : '' }}>Manual</option>
                    <option value="Automatic" {{ old('transmission', $vehicle->transmission) == 'Automatic' ? 'selected' : '' }}>Automatic</option>
                </select>
                @error('transmission') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    <option value="available" {{ old('status', $vehicle->status) == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="maintenance" {{ old('status', $vehicle->status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                    <option value="booked" {{ old('status', $vehicle->status) == 'booked' ? 'selected' : '' }}>Booked</option>
                    <option value="rented" {{ old('status', $vehicle->status) == 'rented' ? 'selected' : '' }}>Rented</option>
                </select>
                @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Image -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                @if($vehicle->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $vehicle->image) }}" class="h-20 rounded" alt="Current Image">
                    </div>
                @endif
                <input type="file" name="image" id="image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                <p class="text-xs text-gray-500 mt-1">Leave blank to keep current image.</p>
                @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Description -->
        <div class="mt-6">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $vehicle->description) }}</textarea>
            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mt-6 flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update Vehicle</button>
            <a href="{{ route('admin.vehicles.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300">Cancel</a>
        </div>
    </form>
</div>
@endsection
