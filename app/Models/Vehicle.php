<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Builder;

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
        'organization_id'
    ];



    protected static function booted(): void
    {
        static::addGlobalScope('onlyForOrganization', function (Builder $builder) {
            $builder->where('organization_id', session()->get('organization_id') ?? getPermissionsTeamId()); 
        });
    }


    public function vehicleDevice(): HasOne
    {
        return $this->hasOne(VehicleDevice::class);
    }

    // /**
    //  * Get the device associated with the vehicle.
    //  *
    //  */
    // public function device()
    // {
    //     return $this->hasOneThrough(
    //         Device::class,
    //         VehicleDevice::class,
    //         'vehicle_id', // Foreign key on the "vehicle_devices" table
    //         'id', // Foreign key on the "devices" table
    //         'id', // Local key on the "vehicles" table
    //         'device_id' // Local key on the "vehicle_devices" table
    //     );
    // }

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
    public function dispatches()
    {
        return $this->hasManyThrough(Dispatch::class, OrderVehicle::class);
    }

    public function activeDispatches(){
        return $this->dispatches()->where('status', 'transit');
    }

    public function latestActiveDispatch()
    {
        return $this->hasOneThrough(Dispatch::class, OrderVehicle::class)->where('status', 'transit');
    }
}
