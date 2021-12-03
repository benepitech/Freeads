<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Ad extends Model
{
    use HasFactory;
  
    protected $fillable = [
        'title', 'category', 'description', 'picture', 'price', 'location','user_id', 'phone_number'
    ];


    protected static function booted()
    {
        static::creating(function ($ads) {
            $ads->user_id = Auth::id();
        });
    }
}


