<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'DriveRent') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('partials.darkmode-script')
</head>
<body class="font-sans antialiased bg-white dark:bg-slate-950 text-blue-950 dark:text-slate-100">
    <nav class="bg-white/80 dark:bg-slate-950/80 backdrop-blur-md border-b border-blue-100 dark:border-slate-800 sticky top-0 z-50 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between h-20 items-center">
            <div class="flex items-center">
                @if(request()->routeIs('vehicles.index') || request()->routeIs('vehicles.show') || request()->routeIs('shops.index'))
                <button onclick="window.history.back()" class="mr-4 text-blue-500 hover:text-blue-950 dark:hover:text-white focus:outline-none transition-colors" title="Go Back">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </button>
                @endif
                <a href="/" class="text-2xl font-extrabold tracking-tight text-blue-950 dark:text-slate-100">DRIVE<span class="text-blue-500 font-medium">RENT</span></a>
                <div class="hidden md:flex space-x-8 ml-12">
                    <a href="{{ route('shops.index') }}" class="text-sm text-blue-600 dark:text-blue-500 hover:text-blue-950 dark:hover:text-white font-medium transition-colors">Rental Shops</a>
                    @auth
                        @if(Auth::user()->role === 'customer')
                            <a href="{{ route('dashboard') }}" class="text-sm text-blue-600 dark:text-blue-500 hover:text-blue-950 dark:hover:text-white font-medium transition-colors">My Bookings</a>
                        @endif
                    @endauth
                </div>
            </div>
            <div class="flex items-center space-x-6">
                @include('partials.darkmode-toggle')

                @auth
                    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'vendor')
                        <a href="{{ route('admin.dashboard') }}" class="hidden md:inline-block text-sm font-medium text-blue-950 dark:text-slate-100 hover:opacity-70 transition-opacity">Dashboard</a>
                    @endif
                    
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.away="open = false" class="flex items-center text-sm font-medium text-blue-800 dark:text-slate-300 hover:text-blue-950 dark:hover:text-white focus:outline-none transition-colors">
                            <div class="w-8 h-8 rounded-full bg-blue-50 dark:bg-zinc-800 text-blue-950 dark:text-slate-100 flex items-center justify-center mr-2 font-bold shadow-sm">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span class="hidden md:inline font-semibold">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 ml-1 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>

                        <div x-show="open" x-transition.opacity class="absolute right-0 mt-2 w-48 bg-white dark:bg-slate-900 rounded-xl shadow-xl py-2 border border-blue-100 dark:border-slate-800 z-50">
                            <div class="px-4 py-3 border-b border-gray-50 dark:border-slate-800 mb-1">
                                <p class="text-sm text-blue-950 dark:text-slate-100 font-bold">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-blue-600 dark:text-blue-500 truncate mt-0.5">{{ Auth::user()->email }}</p>
                            </div>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-blue-800 dark:text-slate-300 hover:bg-zinc-50 dark:hover:bg-slate-800 hover:text-blue-950 dark:hover:text-white transition-colors">Profile Settings</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-blue-800 dark:text-slate-300 hover:bg-zinc-50 dark:hover:bg-slate-800 hover:text-red-600 dark:hover:text-red-400 transition-colors">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-blue-800 dark:text-blue-500 hover:text-blue-950 dark:hover:text-white transition-colors">Log In</a>
                    <a href="{{ route('register') }}" class="bg-slate-900 dark:bg-white text-white dark:text-blue-950 px-5 py-2.5 rounded-full text-sm font-semibold hover:opacity-90 transition-opacity">Sign Up</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="min-h-screen">
        @if (session('success'))
            <div class="max-w-7xl mx-auto mt-4 px-4 sm:px-6 lg:px-8">
                <div class="bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-300 px-4 py-3 rounded-md relative">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        @if (session('error'))
            <div class="max-w-7xl mx-auto mt-4 px-4 sm:px-6 lg:px-8">
                <div class="bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-700 text-red-700 dark:text-red-300 px-4 py-3 rounded-md relative">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-slate-900 dark:bg-gray-950 text-white py-8 text-center mt-12 border-t border-gray-700 dark:border-slate-800">
        <p>&copy; {{ date('Y') }} DriveRent. All rights reserved.</p>
    </footer>
</body>
</html>
