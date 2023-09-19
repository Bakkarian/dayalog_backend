<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dispatch extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];



    public function orderVehicle()
    {
        return $this->belongsTo(OrderVehicle::class);
    }

    //Faked relastionships( Cannot use where has)
    public function vehicle()
    {
       return $this->orderVehicle->vehicle();
    }


    public function  device(){
         return $this->vehicle->device();
    }

    public function deviceEvents()
    {
        return $this->hasMany(DispatchedDeviceEvents::class);
    }

}
