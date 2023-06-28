<?php
namespace App\Services;

use App\Models\Device;
use App\Models\TCDevice;

class DeviceService {

 public function store(array $data): Device
 {
     $device = TCDevice::create($data);
     return Device::find($device->id);
 }

 public function update(array $data, TCDevice $device): Device
 {
     $device->update($data);
     return Device::find($device->id);
 }
}

