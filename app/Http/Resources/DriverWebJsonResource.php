<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DriverWebJsonResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->bioData->name,
            'driver_id' => $this->id,
            'user_id' => $this->bioData->id,
            'patasente_id' => $this->bioData->patasente_id,
        ];
    }
}
