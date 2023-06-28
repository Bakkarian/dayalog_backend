<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;
    public function vehicle()
    {
        return $this->hasOneThrough(
            Vehicle::class,
            VehicleDevice::class,
            'device_id',// Foreign key on the VehicleDevice model
            'id', // Foreign key on the Vehicle model
            'id', // Local key on the Device model
            'vehicle_id',  // Local key on the VehicleDevice model
        );
    }

    //TODO: Create a custom delete that caters for the tc_user_device table
}
