<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Device extends Model
{
    use HasFactory;

    protected $connection = 'traccar';

    protected $table = 'tc_devices';

      /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope('removeIvan', function (Builder $builder) {
            $builder->where('uniqueid', '!=', '038020188471');
        });
    }

    public function vehicleDevice(): HasOne
    {
        return $this->setConnection(config('database.default'))->hasOne(VehicleDevice::class);
    }


    public function vehicle()
    {
        return $this->setConnection(config('database.default'))->hasOneThrough(
            Vehicle::class,
            VehicleDevice::class,
            'device_id',// Foreign key on the VehicleDevice model
            'id', // Foreign key on the Vehicle model
            'id', // Local key on the Device model
            'vehicle_id',  // Local key on the VehicleDevice model
        );
    }


    public function positions()
    {
        return $this->setConnection(config('database.default'))->hasMany(DevicePosition::class, 'deviceid');
    }

    public function lastPosition()
    {
        return $this->setConnection(config('database.default'))->belongsTo(DevicePosition::class, 'positionid');
    }

    //TODO: Create a custom delete that caters for the tc_user_device table
}
