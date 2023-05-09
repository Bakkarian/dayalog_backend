<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $connection = 'traccar';

    protected $table = 'tc_devices';

    protected $attributes = [
        'attributes' => '{}',
    ];

    protected $fillable = [
        'name',
        'uniqueid',
        'model'
    ];
}
