<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $casts = [
        'order_date' => 'datetime',
    ];

    // public function getOrderDateAttribute($value)
    // {
    //     return $value ? \Carbon\Carbon::parse($value) : null;
    // }
}
