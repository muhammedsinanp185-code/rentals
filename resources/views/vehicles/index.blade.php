@extends('layouts.main')

@section('content')
<!-- Minimal Hero Section -->
<div class="relative bg-black text-white py-24 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-b from-zinc-900/50 to-zinc-950/90 z-0"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-center text-center">
        <h1 class="text-5xl md:text-7xl font-extrabold tracking-tighter mb-6 leading-tight">
            The Drive <br> <span class="text-blue-500 font-medium tracking-tight">Redefined.</span>
        </h1>
        <p class="text-lg md:text-xl text-blue-500 max-w-2xl font-light">Explore a curated fleet of premium vehicles designed for every journey. No compromises, just the open road.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="flex flex-col lg:flex-row gap-12">
        <!-- Minimal Filters (Left Column) -->
        <div class="w-full lg:w-1/4">
            <div class="sticky top-28 space-y-8">
                <div>
                    <h3 class="text-sm font-bold text-blue-950 dark:text-yellow-400 uppercase tracking-widest mb-6 border-b border-blue-200 dark:border-yellow-900/50 pb-4">Refine Search</h3>
                    <form action="{{ route('vehicles.index') }}" method="GET" class="space-y-6">
                        
                        <!-- Search -->
                        <div>
                            <label class="block text-xs font-semibold text-blue-600 dark:text-blue-500 uppercase tracking-wider mb-2">Search</label>
                            <input type="text" name="search" value="{{ request('search') }}" class="w-full bg-white dark:bg-[#111111] border-none rounded-none border-b-2 border-blue-200 dark:border-yellow-900/50 focus:border-zinc-900 dark:focus:border-white focus:ring-0 text-sm py-2 px-0 dark:text-yellow-400 placeholder-gray-400 transition-colors" placeholder="Brand, model...">
                        </div>
                        
                        <!-- Category -->
                        <div>
                            <label class="block text-xs font-semibold text-blue-600 dark:text-blue-500 uppercase tracking-wider mb-2">Category</label>
                            <select name="category" class="w-full bg-white dark:bg-[#111111] border-none rounded-none border-b-2 border-blue-200 dark:border-yellow-900/50 focus:border-zinc-900 dark:focus:border-white focus:ring-0 text-sm py-2 px-0 dark:text-yellow-400 transition-colors">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Price -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-blue-600 dark:text-blue-500 uppercase tracking-wider mb-2">Min Price</label>
                                <input type="number" name="min_price" value="{{ request('min_price') }}" class="w-full bg-white dark:bg-[#111111] border-none rounded-none border-b-2 border-blue-200 dark:border-yellow-900/50 focus:border-zinc-900 dark:focus:border-white focus:ring-0 text-sm py-2 px-0 dark:text-yellow-400 placeholder-gray-400 transition-colors" placeholder="₹">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-blue-600 dark:text-blue-500 uppercase tracking-wider mb-2">Max Price</label>
                                <input type="number" name="max_price" value="{{ request('max_price') }}" class="w-full bg-white dark:bg-[#111111] border-none rounded-none border-b-2 border-blue-200 dark:border-yellow-900/50 focus:border-zinc-900 dark:focus:border-white focus:ring-0 text-sm py-2 px-0 dark:text-yellow-400 placeholder-gray-400 transition-colors" placeholder="₹">
                            </div>
                        </div>

                        <div class="pt-4 flex flex-col space-y-3">
                            <button type="submit" class="w-full bg-[#111111] dark:bg-white text-white dark:text-blue-950 py-3 text-sm font-bold tracking-wide uppercase hover:opacity-90 transition-opacity">Apply</button>
                            @if(request()->anyFilled(['search', 'category', 'min_price', 'max_price', 'shop']))
                            <a href="{{ route('vehicles.index') }}" class="w-full text-center text-xs font-semibold text-blue-600 hover:text-blue-950 dark:hover:text-white uppercase tracking-widest transition-colors">Reset</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Minimal Vehicle Grid (Right Column) -->
        <div class="w-full lg:w-3/4">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-x-8 gap-y-12">
                @forelse($vehicles as $vehicle)
                    <div class="group flex flex-col">
                        <!-- Edge-to-edge image container -->
                        <div class="relative w-full aspect-[4/3] bg-blue-50 dark:bg-[#111111] overflow-hidden mb-5">
                            @if($vehicle->image)
                                <img src="{{ asset('storage/' . $vehicle->image) }}" alt="{{ $vehicle->name }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 ease-in-out">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-blue-500 font-medium">No Image</div>
                            @endif
                            <div class="absolute top-4 left-4 bg-white/90 dark:bg-[#111111]/90 backdrop-blur-sm px-3 py-1 text-xs font-bold tracking-wider uppercase text-blue-950 dark:text-yellow-400">
                                {{ $vehicle->category->name ?? 'Vehicle' }}
                            </div>
                        </div>
                        
                        <!-- Content -->
                        <div class="flex-1 flex flex-col">
                            <div class="flex justify-between items-start mb-1">
                                <div>
                                    <h3 class="text-2xl font-bold text-blue-950 dark:text-yellow-400 group-hover:text-blue-800 dark:group-hover:text-gray-300 transition-colors">
                                        <a href="{{ route('vehicles.show', $vehicle) }}">
                                            <span class="absolute inset-0"></span>
                                            {{ $vehicle->name }}
                                        </a>
                                    </h3>
                                    <p class="text-sm text-blue-600 mt-1">{{ $vehicle->brand }} {{ $vehicle->model }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="text-xl font-bold text-blue-950 dark:text-yellow-400">₹{{ number_format($vehicle->price_per_day, 0) }}</span>
                                    <span class="block text-xs text-blue-600 uppercase tracking-widest mt-0.5">/ day</span>
                                </div>
                            </div>
                            
                            <div class="mt-4 pt-4 border-t border-blue-100 dark:border-yellow-900/50 flex items-center justify-between text-xs font-semibold text-blue-500 uppercase tracking-wider">
                                <div class="flex space-x-4">
                                    <span>{{ $vehicle->seats }} Seats</span>
                                    <span>{{ $vehicle->transmission }}</span>
                                </div>
                                <div class="flex items-center text-blue-950 dark:text-yellow-400">
                                    <span>By {{ $vehicle->shop->name ?? 'Unknown' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center">
                        <h3 class="text-2xl font-bold text-blue-950 dark:text-yellow-400 mb-2">No Vehicles Found.</h3>
                        <p class="text-blue-600 mb-6">We couldn't find anything matching your criteria.</p>
                        <a href="{{ route('vehicles.index') }}" class="inline-block border-b-2 border-zinc-900 dark:border-white text-blue-950 dark:text-yellow-400 pb-1 font-bold tracking-wider uppercase text-sm hover:opacity-70 transition-opacity">Clear Search</a>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $vehicles->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
