<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TCDevice extends Model
{
    use HasFactory;

    protected $connection = 'traccar';

    protected $table = 'tc_devices';

    public $timestamps = false;

    protected $attributes = [
        'attributes' => '{}',
    ];

    protected $fillable = [
        'name',
        'uniqueid',
        'model'
    ];

    public static function create(array $attributes = [])
    {
        $device = static::query()->create($attributes);

        $connectionName = (new static())->getConnectionName();

        DB::connection($connectionName)->table('tc_user_device')->insert([
            'userid'=> $attributes['tc_user_id'] ?? 1,
            'deviceid'=> $device->id
        ]);

        return $device;
    }
    //TODO: Create a custom delete that caters for the tc_user_device table
}
