<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['name','comment','itemId','star','good'];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
