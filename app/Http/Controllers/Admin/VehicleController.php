<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Vehicle;
use App\Models\VehicleCategory;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    public function index()
    {
        $query = Vehicle::with('category');
        
        if (auth()->user()->role === 'vendor') {
            $query->where('shop_id', auth()->user()->shop->id);
        }
        
        $vehicles = $query->paginate(10);
        return view('admin.vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        $categories = VehicleCategory::all();
        return view('admin.vehicles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_category_id' => 'required|exists:vehicle_categories,id',
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'registration_number' => 'required|string|max:255|unique:vehicles',
            'description' => 'nullable|string',
            'price_per_day' => 'required|numeric|min:0',
            'seats' => 'required|integer|min:1',
            'fuel_type' => 'required|string|max:255',
            'transmission' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:available,booked,rented,maintenance',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('vehicles', 'public');
        }

        if (auth()->user()->role === 'vendor') {
            $validated['shop_id'] = auth()->user()->shop->id;
        }

        Vehicle::create($validated);

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle created successfully.');
    }

    public function edit(Vehicle $vehicle)
    {
        if (auth()->user()->role === 'vendor' && $vehicle->shop_id !== auth()->user()->shop->id) {
            abort(403, 'Unauthorized access.');
        }
        $categories = VehicleCategory::all();
        return view('admin.vehicles.edit', compact('vehicle', 'categories'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        if (auth()->user()->role === 'vendor' && $vehicle->shop_id !== auth()->user()->shop->id) {
            abort(403, 'Unauthorized access.');
        }
        $validated = $request->validate([
            'vehicle_category_id' => 'required|exists:vehicle_categories,id',
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'registration_number' => 'required|string|max:255|unique:vehicles,registration_number,' . $vehicle->id,
            'description' => 'nullable|string',
            'price_per_day' => 'required|numeric|min:0',
            'seats' => 'required|integer|min:1',
            'fuel_type' => 'required|string|max:255',
            'transmission' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:available,booked,rented,maintenance',
        ]);

        if ($request->hasFile('image')) {
            if ($vehicle->image) {
                Storage::disk('public')->delete($vehicle->image);
            }
            $validated['image'] = $request->file('image')->store('vehicles', 'public');
        }

        $vehicle->update($validated);

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle updated successfully.');
    }

    public function destroy(Vehicle $vehicle)
    {
        if (auth()->user()->role === 'vendor' && $vehicle->shop_id !== auth()->user()->shop->id) {
            abort(403, 'Unauthorized access.');
        }

        if ($vehicle->bookings()->whereIn('status', ['pending', 'approved', 'completed'])->count() > 0) {
            return redirect()->route('admin.vehicles.index')->with('error', 'Cannot delete vehicle with active bookings.');
        }

        if ($vehicle->image) {
            Storage::disk('public')->delete($vehicle->image);
        }

        $vehicle->delete();

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle deleted successfully.');
    }
}
