<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevicePosition extends Model
{
    use HasFactory;

    protected $connection = 'traccar';

    protected $table = 'tc_positions';

    const CREATED_AT = 'servertime';

    const UPDATED_AT = 'servertime';


    public function dispatches()
    {
        return $this->setConnection(config('database.default'))->belongsToMany(Dispatch::class);
    }

}
