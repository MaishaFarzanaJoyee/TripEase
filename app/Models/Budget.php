<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = ['amount']; // ✅ Allow mass assignment of 'amount'
}
// public function user()
// {
//     return $this->belongsTo(User::class);
// }

