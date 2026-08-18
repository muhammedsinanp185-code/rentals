@extends('layouts.main')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mb-16 gap-6">
        <div>
            <h1 class="text-4xl md:text-5xl font-extrabold text-blue-950 dark:text-slate-100 tracking-tight mb-4">Rental Partners.</h1>
            <p class="text-lg text-blue-600 max-w-2xl font-light">Select a shop to explore their exclusive fleet of vehicles.</p>
        </div>
        <div>
            <a href="{{ route('vehicles.index') }}" class="inline-block border-b-2 border-zinc-900 dark:border-white text-blue-950 dark:text-slate-100 pb-1 font-bold tracking-wider uppercase text-sm hover:opacity-70 transition-opacity">Search All Vehicles &rarr;</a>
        </div>
    </div>

    @if($shops->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12">
            @foreach($shops as $shop)
                <div class="group relative flex flex-col items-start">
                    <a href="{{ route('vehicles.index', ['shop' => $shop->id]) }}" class="absolute inset-0 z-10"><span class="sr-only">View Shop</span></a>
                    
                    <div class="w-full aspect-[16/9] bg-blue-50 dark:bg-slate-900 mb-6 flex items-center justify-center overflow-hidden transition-colors group-hover:bg-zinc-200 dark:group-hover:bg-zinc-800">
                        <svg class="w-12 h-12 text-zinc-300 dark:text-zinc-700 transform group-hover:scale-110 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    
                    <h3 class="text-2xl font-bold text-blue-950 dark:text-slate-100 mb-2">{{ $shop->name }}</h3>
                    <p class="text-sm text-blue-600 line-clamp-2 mb-4 font-light">
                        {{ $shop->description ?: 'No description provided.' }}
                    </p>
                    
                    <div class="space-y-1 mb-6 text-xs font-semibold text-blue-500 uppercase tracking-widest">
                        @if($shop->phone)
                            <div class="flex items-center">
                                <span>Ph: {{ $shop->phone }}</span>
                            </div>
                        @endif
                        <div class="flex items-center text-blue-950 dark:text-slate-100 mt-2">
                            <span>{{ $shop->vehicles_count }} Vehicles Listed</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="py-20 text-center">
            <h3 class="text-2xl font-bold text-blue-950 dark:text-slate-100 mb-2">No Shops Found.</h3>
            <p class="text-blue-600">It looks like there are no registered rental shops yet.</p>
        </div>
    @endif
</div>
@endsection
