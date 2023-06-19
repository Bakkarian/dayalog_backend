<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class OrderVehicle extends Model
{
    use SoftDeletes;

    protected $table ='order_vehicle';

}
