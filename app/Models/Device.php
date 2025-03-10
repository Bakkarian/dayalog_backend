<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class Device extends Model
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
        'model',
        'status'
    ];
    
     /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope('removeIvan', function (Builder $builder) {
            
            $devices = DeviceOrganization::where('organization_id',  (session()->get('organization_id') ?? getPermissionsTeamId()) )->get()->pluck('device_id')->toArray();

            $builder->whereIn('id', $devices);
            
        });
    }


    public static function create(array $attributes = [])
    {
        $device = static::query()->create([...$attributes , 'status' => 'offline']);
        $connectionName = (new static())->getConnectionName();

        DB::connection($connectionName)->table('tc_user_device')->insert([
            'userid'=> $attributes['tc_user_id'] ?? 1,
            'deviceid'=> $device->id,
            
        ]);

        return $device;
    }


    /**
     * The roles that belong to the user.
     */
    public function organizations(): BelongsToMany
    {
        $this->setConnection(config('database.default'));

        return $this->belongsToMany(Organization::class);
    }

    public function vehicleDevice(): HasOne
    {
        return $this->setConnection(config('database.default'))->hasOne(VehicleDevice::class);
    }


    public function vehicle()
    {
        $this->setConnection(config('database.default'));
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
