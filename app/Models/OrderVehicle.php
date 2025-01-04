<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class OrderVehicle extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $table ='order_vehicle';

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function dispatches()
    {
        return $this->hasMany(Dispatch::class);
    }

    public function activeDispatches(){
        return $this->dispatches()->where('status', 'transit');
    }
}
