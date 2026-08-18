<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

use App\Http\Controllers\BookingController;
use App\Http\Controllers\VehicleController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [BookingController::class, 'index'])->name('dashboard');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::post('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
});

Route::middleware('auth')->group(function () {
    Route::get('/shops', [\App\Http\Controllers\ShopController::class, 'index'])->name('shops.index');
    Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
    Route::get('/vehicles/{vehicle}', [VehicleController::class, 'show'])->name('vehicles.show');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\VehicleController as AdminVehicleController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\CustomerController;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->role === 'vendor') {
            $shopId = $user->shop->id;
            $stats = [
                'total_vehicles' => \App\Models\Vehicle::where('shop_id', $shopId)->count(),
                'available_vehicles' => \App\Models\Vehicle::where('shop_id', $shopId)->where('status', 'available')->count(),
                'pending_bookings' => \App\Models\Booking::whereHas('vehicle', function($q) use ($shopId) { $q->where('shop_id', $shopId); })->where('status', 'pending')->count(),
                'total_customers' => \App\Models\Booking::whereHas('vehicle', function($q) use ($shopId) { $q->where('shop_id', $shopId); })->distinct('user_id')->count(),
                'recent_bookings' => \App\Models\Booking::whereHas('vehicle', function($q) use ($shopId) { $q->where('shop_id', $shopId); })->with(['user', 'vehicle'])->latest()->take(5)->get(),
            ];
        } else {
            $stats = [
                'total_vehicles' => \App\Models\Vehicle::count(),
                'available_vehicles' => \App\Models\Vehicle::where('status', 'available')->count(),
                'pending_bookings' => \App\Models\Booking::where('status', 'pending')->count(),
                'total_customers' => \App\Models\User::where('role', 'customer')->count(),
                'recent_bookings' => \App\Models\Booking::with(['user', 'vehicle'])->latest()->take(5)->get(),
            ];
        }
        return view('admin.dashboard', compact('stats'));
    })->name('dashboard');

    Route::resource('vehicles', AdminVehicleController::class);
    
    Route::get('bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
    Route::patch('bookings/{booking}/status', [AdminBookingController::class, 'updateStatus'])->name('bookings.update-status');
    Route::get('shop', [\App\Http\Controllers\Admin\ShopProfileController::class, 'edit'])->name('shop.edit');
    Route::put('shop', [\App\Http\Controllers\Admin\ShopProfileController::class, 'update'])->name('shop.update');
    
    // Super Admin only routes (protected in controllers or UI for now)
    Route::resource('categories', CategoryController::class);
    Route::get('customers', [CustomerController::class, 'index'])->name('customers.index');
});

require __DIR__.'/auth.php';
