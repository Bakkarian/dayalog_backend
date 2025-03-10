<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'items' => 'array',
    ];


    protected static function booted(): void
    {
        static::addGlobalScope('onlyForOrganization', function (Builder $builder) {
            $builder->when(session()->get('organization_id') || getPermissionsTeamId() ,  function ($q){
                $q->whereHas('organizations' , function ($q){
                    $q->whereIn('organizations.id', [session()->get('organization_id')  ?? getPermissionsTeamId() ]  );
                });
            });
        });
    }


    public function orderVehicles()
    {
        return $this->hasMany(OrderVehicle::class);
    }


    public function to()
    {
        return $this->belongsTo(User::class,'to');
    }


    public function from()
    {
        return $this->belongsTo(User::class, 'from');
    }


    public function trips()
    {
        return $this->hasMany(OrderTrip::class);
    }
    


    public function organizations(): BelongsToMany
    {
        return $this->belongsToMany(Organization::class);
    }
}
