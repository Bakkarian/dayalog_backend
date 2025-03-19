<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserMeta extends Model
{
    

    public $fillable = ['key', 'value', 'user_id', 'organization_id'];
    

    protected static function booted(): void
    {
        static::addGlobalScope('onlyForOrganization', function (Builder $builder) {
            $builder->when(session()->get('organization_id') || getPermissionsTeamId() ,  function ($q){
                $q->whereHas('organizations' , function ($q){
                    $q->whereIn('organizations.id', [session()->get('organization_id') ?? getPermissionsTeamId() ]  );
                });
            });
        });
    }

    public function organizations() : BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }


    public static function getAllUserMeta($user_id)
    {
        $data =  self::where('user_id', $user_id)->get();
        $data = $data->pluck('value', 'key');

        return $data;
    }




    public static function getMeta($user_id, $key)
    {
        return self::where('user_id', $user_id)->where('key', $key)->first();
    }

    public static function updateMeta($user_id, $key, $value)
    {
        
        $meta = self::where('user_id', $user_id)->where('key', $key)->first();
        
        if ($meta) {
            $meta->value = $value;
            $meta->save();
        } else {
            self::create([
                'user_id' => $user_id, 
                'key' => $key, 
                'value' => $value,
                'organization_id' => session()->get('organization_id') ?? getPermissionsTeamId()
            ]);
        }

    }


    public static function deleteMeta($user_id, $key)
    {
        self::where('user_id', $user_id)->where('key', $key)->delete();
    }

    public static function getAllAuthUserMeta()
    {
        return self::getAllUserMeta(auth()->user()->id);
    }

    public static function getAuthUserMeta($key)
    {
        return self::getMeta(auth()->user()->id, $key);
    }

    public static function updateAuthUserMeta($key, $value)
    {
        self::updateMeta(auth()->user()->id, $key, $value);
    }


    public static function deleteAuthUserMeta($key)
    {
        self::deleteMeta(auth()->user()->id, $key);
    }

    
}
