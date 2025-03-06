<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceOrganization extends Model
{
    //

    protected $table = 'device_organization';


    public $fillable = [
        'device_id',
        'organization_id',
    ];

    public $timestamps = false;
}
