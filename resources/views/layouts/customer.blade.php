<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DriveRent') }} - Dashboard</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine -->
    
    @include('partials.darkmode-script')
</head>
<body class="font-sans antialiased bg-white dark:bg-slate-950 text-blue-950 dark:text-slate-100" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen overflow-hidden">
        
        <!-- Mobile sidebar backdrop -->
        <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-20 bg-slate-950/50 lg:hidden" @click="sidebarOpen = false"></div>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-30 w-64 bg-white dark:bg-slate-900 border-r border-blue-100 dark:border-slate-800 text-blue-900 dark:text-slate-100 transition duration-300 transform lg:translate-x-0 lg:static lg:inset-auto">
            <div class="flex items-center justify-center h-20 border-b border-blue-100 dark:border-slate-800 bg-white dark:bg-slate-950">
                <a href="{{ route('vehicles.index') }}" class="text-2xl font-extrabold tracking-tight text-blue-950 dark:text-slate-100">DRIVE<span class="text-blue-500 font-medium">RENT</span></a>
            </div>
            
            <nav class="p-4 space-y-1">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-sm font-semibold rounded-md {{ request()->routeIs('dashboard') ? 'bg-blue-50 dark:bg-zinc-800 text-blue-950 dark:text-slate-100' : 'text-blue-600 dark:text-blue-500 hover:bg-blue-50/50 dark:hover:bg-slate-800/50 hover:text-blue-950 dark:hover:text-white' }} transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    My Bookings
                </a>
                
                <!-- Browse Vehicles -->
                <a href="{{ route('shops.index') }}" class="flex items-center px-4 py-3 text-sm font-semibold rounded-md text-blue-600 dark:text-blue-500 hover:bg-blue-50/50 dark:hover:bg-slate-800/50 hover:text-blue-950 dark:hover:text-white transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    Rental Shops
                </a>
                
                <!-- Profile -->
                <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3 text-sm font-semibold rounded-md {{ request()->routeIs('profile.edit') ? 'bg-blue-50 dark:bg-zinc-800 text-blue-950 dark:text-slate-100' : 'text-blue-600 dark:text-blue-500 hover:bg-blue-50/50 dark:hover:bg-slate-800/50 hover:text-blue-950 dark:hover:text-white' }} transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Profile Settings
                </a>
            </nav>
            
            <div class="absolute bottom-0 w-full p-4 border-t border-blue-100 dark:border-slate-800">
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden dark:bg-slate-950">
            <!-- Header -->
            <header class="h-20 flex items-center justify-between px-6 bg-white/80 dark:bg-slate-950/80 backdrop-blur-md border-b border-blue-100 dark:border-slate-800 z-10">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="text-blue-500 hover:text-blue-950 dark:hover:text-white focus:outline-none lg:hidden mr-4 transition-colors">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    
                    @if(!request()->routeIs('dashboard'))
                    <button onclick="window.history.back()" class="mr-4 text-blue-500 hover:text-blue-950 dark:hover:text-white focus:outline-none transition-colors" title="Go Back">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    </button>
                    @endif

                    <h2 class="text-xl font-bold text-blue-950 dark:text-slate-100">
                        @yield('header')
                    </h2>
                </div>
                
                <div class="flex items-center space-x-6">
                    @include('partials.darkmode-toggle')

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
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-blue-800 dark:text-slate-300 hover:bg-zinc-50 dark:hover:bg-slate-800 hover:text-red-600 dark:hover:text-red-400 transition-colors">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-white dark:bg-slate-950 p-6 sm:p-8">
                @if (session('success'))
                    <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-md shadow-sm">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-green-700 font-medium">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                @if (session('error'))
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-md shadow-sm">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-700 font-medium">{{ session('error') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="max-w-7xl mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>
</html>
