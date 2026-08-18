<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DriveRent Admin') }} - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine -->
    
    @include('partials.darkmode-script')
</head>
<body class="font-sans antialiased bg-white dark:bg-black text-blue-950 dark:text-yellow-400" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen overflow-hidden">
        
        <!-- Mobile sidebar backdrop -->
        <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-20 bg-black/50 lg:hidden" @click="sidebarOpen = false"></div>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-30 w-64 bg-white dark:bg-[#111111] border-r border-blue-100 dark:border-yellow-900/50 text-blue-900 dark:text-yellow-400 transition duration-300 transform lg:translate-x-0 lg:static lg:inset-auto">
            <div class="flex items-center justify-center h-20 border-b border-blue-100 dark:border-yellow-900/50 bg-white dark:bg-black">
                <a href="{{ route('admin.dashboard') }}" class="text-2xl font-extrabold tracking-tight text-blue-950 dark:text-yellow-400 flex flex-col items-center leading-tight">
                    <span>DRIVE<span class="text-blue-500 font-medium">RENT</span></span>
                    <span class="text-blue-600 dark:text-blue-500 text-[10px] uppercase tracking-widest font-bold">{{ Auth::user()->role === 'vendor' ? 'Vendor Portal' : 'Admin Portal' }}</span>
                </a>
            </div>
            
            <nav class="p-4 space-y-1">
                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-sm font-semibold rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 dark:bg-zinc-800 text-blue-950 dark:text-yellow-400' : 'text-blue-600 dark:text-blue-500 hover:bg-white dark:hover:bg-zinc-800/50 hover:text-blue-950 dark:hover:text-white' }} transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard
                </a>

                @if(Auth::user()->role === 'vendor')
                <!-- My Shop -->
                <a href="{{ route('admin.shop.edit') }}" class="flex items-center px-4 py-3 text-sm font-semibold rounded-lg {{ request()->routeIs('admin.shop.*') ? 'bg-blue-50 dark:bg-zinc-800 text-blue-950 dark:text-yellow-400' : 'text-blue-600 dark:text-blue-500 hover:bg-white dark:hover:bg-zinc-800/50 hover:text-blue-950 dark:hover:text-white' }} transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    My Shop
                </a>
                @endif
                
                <!-- Vehicles -->
                <a href="{{ route('admin.vehicles.index') }}" class="flex items-center px-4 py-3 text-sm font-semibold rounded-lg {{ request()->routeIs('admin.vehicles.*') ? 'bg-blue-50 dark:bg-zinc-800 text-blue-950 dark:text-yellow-400' : 'text-blue-600 dark:text-blue-500 hover:bg-white dark:hover:bg-zinc-800/50 hover:text-blue-950 dark:hover:text-white' }} transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                    Vehicles
                </a>
                
                @if(Auth::user()->role === 'admin')
                <!-- Categories -->
                <a href="{{ route('admin.categories.index') }}" class="flex items-center px-4 py-3 text-sm font-semibold rounded-lg {{ request()->routeIs('admin.categories.*') ? 'bg-blue-50 dark:bg-zinc-800 text-blue-950 dark:text-yellow-400' : 'text-blue-600 dark:text-blue-500 hover:bg-white dark:hover:bg-zinc-800/50 hover:text-blue-950 dark:hover:text-white' }} transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Categories
                </a>
                @endif
                
                <!-- Bookings -->
                <a href="{{ route('admin.bookings.index') }}" class="flex items-center px-4 py-3 text-sm font-semibold rounded-lg {{ request()->routeIs('admin.bookings.*') ? 'bg-blue-50 dark:bg-zinc-800 text-blue-950 dark:text-yellow-400' : 'text-blue-600 dark:text-blue-500 hover:bg-white dark:hover:bg-zinc-800/50 hover:text-blue-950 dark:hover:text-white' }} transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Bookings
                </a>
                
                @if(Auth::user()->role === 'admin')
                <!-- Customers -->
                <a href="{{ route('admin.customers.index') }}" class="flex items-center px-4 py-3 text-sm font-semibold rounded-lg {{ request()->routeIs('admin.customers.*') ? 'bg-blue-50 dark:bg-zinc-800 text-blue-950 dark:text-yellow-400' : 'text-blue-600 dark:text-blue-500 hover:bg-white dark:hover:bg-zinc-800/50 hover:text-blue-950 dark:hover:text-white' }} transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    Customers
                </a>
                @endif
            </nav>
            
            <div class="absolute bottom-0 w-full p-4 border-t border-blue-100 dark:border-yellow-900/50">
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden dark:bg-black">
            <!-- Header -->
            <header class="h-20 flex items-center justify-between px-6 bg-white/80 dark:bg-black/80 backdrop-blur-md border-b border-blue-100 dark:border-yellow-900/50 z-10">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="text-blue-500 hover:text-blue-950 dark:hover:text-white focus:outline-none lg:hidden mr-4 transition-colors">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    
                    @if(!request()->routeIs('admin.dashboard'))
                    <button onclick="window.history.back()" class="mr-4 text-blue-500 hover:text-blue-950 dark:hover:text-white focus:outline-none transition-colors" title="Go Back">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    </button>
                    @endif

                    <h2 class="text-xl font-bold text-blue-950 dark:text-yellow-400">
                        @yield('header')
                    </h2>
                </div>
                
                <div class="flex items-center space-x-6">
                    <a href="{{ route('vehicles.index') }}" target="_blank" class="hidden sm:inline-block text-sm font-semibold text-blue-600 hover:text-blue-950 dark:text-blue-500 dark:hover:text-white transition-colors">View Site &rarr;</a>
                    
                    @include('partials.darkmode-toggle')

                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.away="open = false" class="flex items-center text-sm font-medium text-blue-800 dark:text-yellow-500 hover:text-blue-950 dark:hover:text-white focus:outline-none transition-colors">
                            <div class="w-8 h-8 rounded-full bg-blue-50 dark:bg-zinc-800 text-blue-950 dark:text-yellow-400 flex items-center justify-center mr-2 font-bold shadow-sm">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span class="hidden md:inline font-semibold">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 ml-1 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>

                        <div x-show="open" x-transition.opacity class="absolute right-0 mt-2 w-48 bg-white dark:bg-[#111111] rounded-xl shadow-xl py-2 border border-blue-100 dark:border-yellow-900/50 z-50">
                            <div class="px-4 py-3 border-b border-gray-50 dark:border-yellow-900/50 mb-1">
                                <p class="text-sm text-blue-950 dark:text-yellow-400 font-bold">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-blue-600 dark:text-blue-500 truncate mt-0.5">{{ Auth::user()->email }}</p>
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-blue-800 dark:text-yellow-500 hover:bg-zinc-50 dark:hover:bg-zinc-800 hover:text-red-600 dark:hover:text-red-400 transition-colors">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-white dark:bg-black p-6">
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
