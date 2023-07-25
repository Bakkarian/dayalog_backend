<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'license',
        'user_id'
    ];

    public function bioData()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
