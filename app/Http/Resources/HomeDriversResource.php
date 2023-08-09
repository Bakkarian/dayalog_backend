<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeDriversResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'name' => $this->bioData->name,
            'driver_id' => $this->id,
            'user_id' => $this->bioData->id,
            'patasente_id' => $this->bioData->patasente_id,
            'lastDispatch' => $this->vehicles->map(function ($vehicle){
                return $vehicle->dispatches;
            })->flatten()->where('status', 'transit')->first(),

        ];
    }
}
