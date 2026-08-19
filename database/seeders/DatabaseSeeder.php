<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Shop;
use App\Models\Vehicle;
use App\Models\VehicleCategory;
use App\Models\Booking;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Categories
        $suv = VehicleCategory::create(['name' => 'SUV', 'description' => 'Sport Utility Vehicles']);
        $sedan = VehicleCategory::create(['name' => 'Sedan', 'description' => 'Comfortable cars for family']);
        $hatchback = VehicleCategory::create(['name' => 'Hatchback', 'description' => 'Compact cars for city']);
        $luxury = VehicleCategory::create(['name' => 'Luxury', 'description' => 'Premium luxury vehicles']);

        // 2. Create Vendors (Shop Owners)
        $vendor1 = User::create([
            'name' => 'Prime Rentals',
            'email' => 'vendor1@rent.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        
        $vendor2 = User::create([
            'name' => 'City Drive',
            'email' => 'vendor2@rent.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 3. Create Shops for Vendors
        $shop1 = Shop::create([
            'user_id' => $vendor1->id,
            'name' => 'Prime Rentals',
            'description' => 'The best premium rental service in the city.',
            'payment_instructions' => 'Please transfer the rental amount to Account No: 123456789 (IFSC: HDFC0001) or GPay to +91-9876543210. Send screenshot to our WhatsApp.',
        ]);

        $shop2 = Shop::create([
            'user_id' => $vendor2->id,
            'name' => 'City Drive',
            'description' => 'Affordable and reliable cars for everyday use.',
            'payment_instructions' => 'Cash on delivery or UPI: citydrive@ybl. Please contact us 24 hours prior to pickup.',
        ]);

        // 4. Create Customers
        $customer1 = User::create([
            'name' => 'John Doe',
            'email' => 'cust1@rent.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        $customer2 = User::create([
            'name' => 'Jane Smith',
            'email' => 'cust2@rent.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        // 5. Create Vehicles
        $v1 = Vehicle::create([
            'shop_id' => $shop1->id,
            'vehicle_category_id' => $luxury->id,
            'name' => 'Mercedes-Benz C-Class',
            'brand' => 'Mercedes',
            'model' => 'C-Class 2023',
            'year' => 2023,
            'registration_number' => 'MH01AB1234',
            'price_per_day' => 8500,
            'seats' => 5,
            'fuel_type' => 'Petrol',
            'transmission' => 'Automatic',
            'status' => 'available',
            'description' => 'Luxury sedan with premium features and smooth automatic transmission.',
        ]);

        $v2 = Vehicle::create([
            'shop_id' => $shop1->id,
            'vehicle_category_id' => $suv->id,
            'name' => 'Toyota Fortuner',
            'brand' => 'Toyota',
            'model' => 'Fortuner Legender',
            'year' => 2022,
            'registration_number' => 'MH02XY9876',
            'price_per_day' => 6000,
            'seats' => 7,
            'fuel_type' => 'Diesel',
            'transmission' => 'Automatic',
            'status' => 'available',
            'description' => 'Robust SUV for all terrains with ample seating capacity.',
        ]);

        $v3 = Vehicle::create([
            'shop_id' => $shop2->id,
            'vehicle_category_id' => $hatchback->id,
            'name' => 'Hyundai i20',
            'brand' => 'Hyundai',
            'model' => 'i20 Asta',
            'year' => 2021,
            'registration_number' => 'DL04ZC1122',
            'price_per_day' => 2000,
            'seats' => 5,
            'fuel_type' => 'Petrol',
            'transmission' => 'Manual',
            'status' => 'available',
            'description' => 'Perfect city car with great mileage and compact size.',
        ]);
        
        $v4 = Vehicle::create([
            'shop_id' => $shop2->id,
            'vehicle_category_id' => $sedan->id,
            'name' => 'Honda City',
            'brand' => 'Honda',
            'model' => 'City ZX',
            'year' => 2022,
            'registration_number' => 'KA01LM5544',
            'price_per_day' => 3000,
            'seats' => 5,
            'fuel_type' => 'Petrol',
            'transmission' => 'Automatic',
            'status' => 'available',
            'description' => 'Comfortable and spacious sedan for family trips.',
        ]);

        // 6. Create Bookings
        Booking::create([
            'user_id' => $customer1->id,
            'vehicle_id' => $v1->id,
            'start_date' => Carbon::today()->addDays(2),
            'end_date' => Carbon::today()->addDays(4),
            'total_days' => 3,
            'price_per_day' => $v1->price_per_day,
            'total_amount' => $v1->price_per_day * 3,
            'status' => 'approved',
        ]);

        Booking::create([
            'user_id' => $customer2->id,
            'vehicle_id' => $v3->id,
            'start_date' => Carbon::today()->subDays(5),
            'end_date' => Carbon::today()->subDays(2),
            'total_days' => 4,
            'price_per_day' => $v3->price_per_day,
            'total_amount' => $v3->price_per_day * 4,
            'status' => 'completed',
        ]);
        
        Booking::create([
            'user_id' => $customer1->id,
            'vehicle_id' => $v2->id,
            'start_date' => Carbon::today()->addDays(10),
            'end_date' => Carbon::today()->addDays(15),
            'total_days' => 6,
            'price_per_day' => $v2->price_per_day,
            'total_amount' => $v2->price_per_day * 6,
            'status' => 'pending',
        ]);
    }
}
