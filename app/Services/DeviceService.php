<?php
namespace App\Services;

use App\Models\Device;

class DeviceService {

 public function store(array $data): Device
 {
     $device = Device::create($data);
     return $device;
 }

 public function update(array $data, Device $device): Device
 {
     $device->update($data);
     return $device;
 }
}

