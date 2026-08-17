<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'vehicle_category_id',
        'name',
        'brand',
        'model',
        'year',
        'registration_number',
        'description',
        'price_per_day',
        'seats',
        'fuel_type',
        'transmission',
        'image',
        'status'
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function category()
    {
        return $this->belongsTo(VehicleCategory::class, 'vehicle_category_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
