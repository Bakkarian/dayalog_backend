<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'license',
        'user_id'
    ];

    public function bioData()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function vehicles()
    {
        return $this->hasManyThrough(
            Vehicle::class,
            VehicleDriver::class,
            'vehicle_id', // Foreign key on the "vehicle_devices" table
            'id', // Foreign key on the "devices" table
            'id', // Local key on the "vehicles" table
            'driver_id' // Local key on the "vehicle_devices" table
        );
    }

}
