<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    



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
            self::create(['user_id' => $user_id, 'key' => $key, 'value' => $value]);
        }

    }


    public static function deleteMeta($user_id, $key)
    {
        self::where('user_id', $user_id)->where('key', $key)->delete();
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
