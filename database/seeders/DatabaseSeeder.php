<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Categories
        $suv = \App\Models\VehicleCategory::create(['name' => 'SUV', 'description' => 'Sport Utility Vehicle']);
        $sedan = \App\Models\VehicleCategory::create(['name' => 'Sedan', 'description' => 'Comfortable cars for family']);
        $hatchback = \App\Models\VehicleCategory::create(['name' => 'Hatchback', 'description' => 'Compact cars for city']);
    }
}
