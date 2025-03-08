<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Helpers\Traits\Dispatch as DispatchTraits;
class Dispatch extends Model
{
    use HasFactory, SoftDeletes, DispatchTraits;

    protected $guarded = [];



    public function orderVehicle()
    {
        return $this->belongsTo(OrderVehicle::class);
    }

    public function deviceEvents()
    {
        return $this->hasMany(DispatchedDeviceEvents::class);
    }
    
}
