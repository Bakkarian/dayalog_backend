<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTrip extends Model
{
    use HasFactory;


    protected $fillable = [
        'order_id',
        'origin',
        'destination',
        'notes',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    
}
