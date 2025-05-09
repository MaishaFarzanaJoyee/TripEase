<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourPlan extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = ['name', 'description', 'price', 'image', 'duration'];

    // Relationship with the Booking model (A tour plan can have many bookings)
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // You can also define other methods if needed to get specific data, for example, to get popular tours.
}
