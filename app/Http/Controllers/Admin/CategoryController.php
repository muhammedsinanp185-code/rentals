<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\VehicleCategory;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = VehicleCategory::withCount('vehicles')->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:vehicle_categories',
            'description' => 'nullable|string',
        ]);

        VehicleCategory::create($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(VehicleCategory $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, VehicleCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:vehicle_categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(VehicleCategory $category)
    {
        if ($category->vehicles()->count() > 0) {
            return redirect()->route('admin.categories.index')->with('error', 'Cannot delete category with associated vehicles.');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
