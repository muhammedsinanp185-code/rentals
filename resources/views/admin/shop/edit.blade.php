@extends('layouts.admin')

@section('header', 'My Shop Profile')

@section('content')
<div class="mb-4">
    <h3 class="text-lg font-bold dark:text-white">Edit Shop Profile</h3>
</div>

<div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border dark:border-gray-700">
    <form action="{{ route('admin.shop.update') }}" method="POST" class="p-6 space-y-6">
        @csrf
        @method('PUT')

        <!-- Shop Name -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Shop Name</label>
            <input type="text" name="name" value="{{ old('name', $shop->name) }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Phone -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone Number</label>
            <input type="text" name="phone" value="{{ old('phone', $shop->phone) }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Address -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
            <textarea name="address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('address', $shop->address) }}</textarea>
            @error('address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Description -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
            <textarea name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $shop->description) }}</textarea>
            @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Payment Instructions -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Payment Instructions (Shown to customers upon booking)</label>
            <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">e.g., Bank details, UPI ID, or instructions for cash payment.</p>
            <textarea name="payment_instructions" rows="4" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('payment_instructions', $shop->payment_instructions) }}</textarea>
            @error('payment_instructions') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition-colors">Save Profile</button>
        </div>
    </form>
</div>
@endsection
