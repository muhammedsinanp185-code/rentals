<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $shops = \App\Models\Shop::withCount('vehicles')->latest()->get();
        return view('shops.index', compact('shops'));
    }
}
