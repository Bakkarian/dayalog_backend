<?php
namespace App\Services;

use App\Models\Vehicle;
use App\Models\VehicleDevice;

class VehicleService {

 public function store(array $data): Vehicle
 {
        $vehicle = Vehicle::create($data);
        if ($data["attached_device_id"]) {
            $this->attachDevice($vehicle, $data["attached_device_id"]);
        }
        return $vehicle;
 }

 public function update(array $data, Vehicle $vehicle): Vehicle
 {
        $vehicle->update($data);
        return $vehicle;
 }

 public function attachDevice(Vehicle $vehicle ,$device_id): bool
 {
        try {
            $vehicleDevice = new VehicleDevice();
            $vehicleDevice->vehicle_id = $vehicle->id;
            $vehicleDevice->device_id = $device_id;
            $vehicleDevice->save();
        } catch (\Exception $th) {
            return false;
        }

        return true;
 }
}

