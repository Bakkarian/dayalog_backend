<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'items' => 'array',
    ];

    public function orderVehicles()
    {
        return $this->hasMany(OrderVehicle::class);
    }


    public function to()
    {
        return $this->belongsTo(User::class,'to');
    }


    public function from()
    {
        return $this->belongsTo(User::class, 'from');
    }


}
