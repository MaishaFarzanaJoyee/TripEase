<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Allow mass assignment for these fields
    protected $fillable = [
        'name', 'email', 'password',
    ];

    // Hidden attributes (for security)
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Cast attributes to specific types
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relationship with the Booking model (A user can have many bookings)
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // Optionally, you can also define a relationship with tour plans if needed
    public function tourPlans()
    {
        return $this->hasManyThrough(TourPlan::class, Booking::class);
    }
}
