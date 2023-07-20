<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            ...parent::toArray($request),
            'assignedVehicles' => $this->mapAssignedVehicles($this->orderVehicles),
        ];
    }

        /**
     * Map the vehicles and include the dispatches for each vehicle.
     *mapAssignedVehicles
     * @param  mixed  $vehicles
     * @return array
     */
    private function mapAssignedVehicles($order_vehicles): array
    {
        return $order_vehicles->map(function ($order_vehicle) {
            return [
                'order_vehicle_ref' => $order_vehicle->id,
                'vehicle' => $this->mapVehicle($order_vehicle->vehicle),
                'dispatches' => $order_vehicle->dispatches
            ];
        })->all();
    }

    private function mapVehicle($vehicle): array
    {
        return [
                'id' => $vehicle->id,
                'device' => $vehicle->device
            ];
    }
}
