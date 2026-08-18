@extends('layouts.main')

@section('content')
<div class="bg-blue-50 dark:bg-slate-950 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-4">
            <a href="{{ route('vehicles.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 font-medium">&larr; Back to Vehicles</a>
        </div>
        
        <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-blue-200 dark:border-slate-800 overflow-hidden">
            <div class="flex flex-col md:flex-row">
                <!-- Vehicle Image -->
                <div class="md:w-1/2">
                    @if($vehicle->image)
                        <img src="{{ asset('storage/' . $vehicle->image) }}" alt="{{ $vehicle->name }}" class="w-full h-96 object-cover">
                    @else
                        <div class="w-full h-96 bg-blue-100 dark:bg-gray-700 flex items-center justify-center text-blue-600 dark:text-blue-500 text-lg">No Image Available</div>
                    @endif
                </div>
                
                <!-- Vehicle Details -->
                <div class="md:w-1/2 p-8 flex flex-col">
                    <div class="mb-2 flex justify-between items-start">
                        <div>
                            <h1 class="text-3xl font-bold text-blue-950 dark:text-slate-100">{{ $vehicle->name }}</h1>
                            <p class="text-lg text-blue-600 dark:text-blue-500 mt-1">{{ $vehicle->brand }} {{ $vehicle->model }} ({{ $vehicle->year }})</p>
                            <p class="text-sm text-indigo-600 dark:text-indigo-400 mt-2 font-medium flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                Listed by: <a href="{{ route('vehicles.index', ['shop' => $vehicle->shop_id]) }}" class="ml-1 hover:underline">{{ $vehicle->shop->name ?? 'Unknown Shop' }}</a>
                            </p>
                        </div>
                        <span class="bg-blue-50 dark:bg-gray-700 text-blue-900 dark:text-gray-200 text-sm px-3 py-1 rounded-full font-medium">{{ $vehicle->category->name ?? 'N/A' }}</span>
                    </div>

                    <div class="mb-6">
                        <span class="text-3xl font-extrabold text-indigo-600 dark:text-indigo-400">₹{{ number_format($vehicle->price_per_day, 0) }}</span>
                        <span class="text-blue-600 dark:text-blue-500 font-medium">/ day</span>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <div class="bg-white dark:bg-gray-700/50 p-4 rounded-md border border-blue-100 dark:border-slate-800">
                            <span class="block text-sm text-blue-600 dark:text-blue-500 font-medium">Seats</span>
                            <span class="block text-lg font-bold text-blue-950 dark:text-slate-100">{{ $vehicle->seats }}</span>
                        </div>
                        <div class="bg-white dark:bg-gray-700/50 p-4 rounded-md border border-blue-100 dark:border-slate-800">
                            <span class="block text-sm text-blue-600 dark:text-blue-500 font-medium">Fuel Type</span>
                            <span class="block text-lg font-bold text-blue-950 dark:text-slate-100">{{ $vehicle->fuel_type }}</span>
                        </div>
                        <div class="bg-white dark:bg-gray-700/50 p-4 rounded-md border border-blue-100 dark:border-slate-800">
                            <span class="block text-sm text-blue-600 dark:text-blue-500 font-medium">Transmission</span>
                            <span class="block text-lg font-bold text-blue-950 dark:text-slate-100">{{ $vehicle->transmission }}</span>
                        </div>
                        <div class="bg-white dark:bg-gray-700/50 p-4 rounded-md border border-blue-100 dark:border-slate-800">
                            <span class="block text-sm text-blue-600 dark:text-blue-500 font-medium">Status</span>
                            <span class="block text-lg font-bold text-blue-950 dark:text-slate-100 capitalize">{{ $vehicle->status }}</span>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-blue-950 dark:text-slate-100 mb-2">Description</h3>
                        <p class="text-blue-800 dark:text-blue-500 leading-relaxed">{{ $vehicle->description ?: 'No description provided.' }}</p>
                    </div>

                    <div class="mt-auto">
                        @if($vehicle->status === 'maintenance')
                            <div class="bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-400 p-4 rounded-md border border-red-200 dark:border-red-800 text-center font-medium">
                                Currently unavailable for booking (Maintenance)
                            </div>
                        @else
                            <div class="bg-indigo-50 dark:bg-indigo-900/30 p-6 rounded-md border border-indigo-100 dark:border-indigo-800">
                                <h3 class="text-lg font-bold text-blue-950 dark:text-slate-100 mb-4">Request Booking</h3>
                                @auth
                                    @if(Auth::user()->role === 'customer')
                                        <form action="{{ route('bookings.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-blue-950 dark:text-slate-300 mb-1">Start Date</label>
                                                    <input type="date" name="start_date" id="start_date" class="w-full rounded-md border-blue-200 dark:border-gray-600 dark:bg-slate-900 dark:text-slate-100 shadow-sm focus:border-blue-500 focus:ring-blue-500" required min="{{ date('Y-m-d') }}">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-blue-950 dark:text-slate-300 mb-1">End Date</label>
                                                    <input type="date" name="end_date" id="end_date" class="w-full rounded-md border-blue-200 dark:border-gray-600 dark:bg-slate-900 dark:text-slate-100 shadow-sm focus:border-blue-500 focus:ring-blue-500" required min="{{ date('Y-m-d') }}">
                                                </div>
                                            </div>
                                            
                                            <div class="mb-4">
                                                <div class="flex justify-between items-center text-sm font-medium text-blue-950 dark:text-slate-300 mb-1">
                                                    <span>Total Estimated:</span>
                                                    <span id="total_estimate" class="text-lg font-bold text-indigo-600 dark:text-indigo-400">₹0</span>
                                                </div>
                                                <p class="text-xs text-blue-600 dark:text-blue-500 text-right">Calculated automatically</p>
                                            </div>

                                            <button type="submit" class="w-full bg-indigo-600 text-white py-3 px-4 rounded-md font-bold hover:bg-indigo-700 transition-colors shadow-sm text-lg">Book Now</button>
                                        </form>
                                    @else
                                        <div class="text-center p-3 bg-white dark:bg-slate-900 rounded-md border border-blue-200 dark:border-slate-800 text-blue-800 dark:text-blue-500">
                                            Admins cannot book vehicles.
                                        </div>
                                    @endif
                                @else
                                    <div class="text-center p-4 bg-white dark:bg-slate-900 rounded-md border border-blue-200 dark:border-slate-800">
                                        <p class="text-blue-800 dark:text-blue-500 mb-3">Please login to book this vehicle.</p>
                                        <a href="{{ route('login') }}" class="inline-block bg-indigo-600 text-white py-2 px-6 rounded-md font-medium hover:bg-indigo-700">Login</a>
                                        <a href="{{ route('register') }}" class="inline-block bg-white dark:bg-slate-900 text-indigo-600 dark:text-indigo-400 border border-indigo-600 dark:border-indigo-400 py-2 px-6 rounded-md font-medium hover:bg-indigo-50 dark:hover:bg-gray-700 ml-2">Register</a>
                                    </div>
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');
        const totalEstimateDisplay = document.getElementById('total_estimate');
        const pricePerDay = {{ $vehicle->price_per_day }};

        function calculateTotal() {
            if (!startDateInput || !endDateInput) return;
            
            const start = new Date(startDateInput.value);
            const end = new Date(endDateInput.value);
            
            if (start && end && end >= start) {
                // Ensure end date min is updated
                endDateInput.min = startDateInput.value;
                
                // Calculate days (including the start day, so end - start + 1)
                const diffTime = Math.abs(end - start);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
                
                const total = diffDays * pricePerDay;
                totalEstimateDisplay.textContent = '₹' + total.toLocaleString('en-IN');
            } else {
                totalEstimateDisplay.textContent = '₹0';
            }
        }

        if(startDateInput) {
            startDateInput.addEventListener('change', calculateTotal);
        }
        if(endDateInput) {
            endDateInput.addEventListener('change', calculateTotal);
        }
    });
</script>
@endsection
