<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'vin',
        'number_plate',
        'make',
        'model',
        'capacity_weight',
        'capacity_volume',
        'insurance_policy_number',
        'insurance_coverage',
        'insurance_expiration',
    ];

    /**
     * Get the device associated with the vehicle.
     *
     */
    public function device()
    {
        return $this->hasOneThrough(
            Device::class,
            VehicleDevice::class,
            'vehicle_id', // Foreign key on the "vehicle_devices" table
            'id', // Foreign key on the "devices" table
            'id', // Local key on the "vehicles" table
            'device_id' // Local key on the "vehicle_devices" table
        );
    }

    public function driver()
    {
        return $this->hasOneThrough(
            Driver::class,
            VehicleDriver::class,
            'vehicle_id', // Foreign key on the "vehicle_devices" table
            'id', // Foreign key on the "devices" table
            'id', // Local key on the "vehicles" table
            'driver_id' // Local key on the "vehicle_devices" table
        );
    }
}
