<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DispatchedDeviceEvents extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function devicePosition()
    {
        return $this->belongsTo(DevicePosition::class);
    }

}
