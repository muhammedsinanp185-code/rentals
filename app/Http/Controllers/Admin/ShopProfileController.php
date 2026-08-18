<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopProfileController extends Controller
{
    public function edit()
    {
        $shop = Auth::user()->shop;
        
        if (!$shop) {
            return redirect()->route('admin.dashboard')->with('error', 'You do not have a shop profile.');
        }

        return view('admin.shop.edit', compact('shop'));
    }

    public function update(Request $request)
    {
        $shop = Auth::user()->shop;
        
        if (!$shop) {
            return redirect()->route('admin.dashboard')->with('error', 'You do not have a shop profile.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'description' => 'nullable|string',
            'payment_instructions' => 'nullable|string',
        ]);

        $shop->update($validated);

        return redirect()->route('admin.shop.edit')->with('success', 'Shop profile updated successfully.');
    }
}
