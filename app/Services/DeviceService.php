<?php
namespace App\Services;

use App\Models\Device;
use App\Models\DeviceOrganization;
use App\Models\Organization;

class DeviceService {

 public function store(array $data)
 {
     $device = Device::create($data);

     DeviceOrganization::create([
         'device_id' => $device->id,
         'organization_id' => session()->get('organization_id')
     ]);
     
     return $device;
 }

 public function update(array $data, Device $device): Device
 {
     $device->update($data);
     return Device::find($device->id);
 }
}

