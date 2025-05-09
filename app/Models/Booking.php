<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = ['user_id', 'tour_plan_id', 'start_date', 'end_date'];
    

    // Relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with the TourPlan model
    public function tourPlan()
    {
        return $this->belongsTo(TourPlan::class);
    }
}

