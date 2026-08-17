<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Vehicle;
use App\Models\VehicleCategory;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        $query = Vehicle::with(['category', 'shop'])->where('status', '!=', 'maintenance');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('brand', 'like', '%' . $request->search . '%')
                  ->orWhere('model', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('vehicle_category_id', $request->category);
        }

        if ($request->filled('shop')) {
            $query->where('shop_id', $request->shop);
        }

        if ($request->filled('min_price')) {
            $query->where('price_per_day', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price_per_day', '<=', $request->max_price);
        }

        $vehicles = $query->paginate(12)->withQueryString();
        $categories = VehicleCategory::all();

        return view('vehicles.index', compact('vehicles', 'categories'));
    }

    public function show(Vehicle $vehicle)
    {
        return view('vehicles.show', compact('vehicle'));
    }
}
