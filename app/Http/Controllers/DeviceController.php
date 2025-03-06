<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeviceRequest;
use App\Http\Resources\DeviceResource;
use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    /**
     * Display a listing of the devices.
     * @group  Devices
     */
    public function index()
    {
        return DeviceResource::collection(Device::paginate(25));
    }

    /**
     * Add a new device.
     * @group  Devices
     */
    public function store(DeviceRequest $request)
    {
        $device = Device::create([
            'name' =>  $request->name,
            'uniqueid' => $request->uniqueid,
            'model' => $request->model,
        ]);

        $device = Device::find($device->id);
        return new DeviceResource($device);
    }

    /**
     * Get information on a device
     * @group  Devices
     */
    public function show(Device $device)
    {
        return new DeviceResource($device);
    }

    /**
     * Update the specified device.
     * @group  Devices
     */
    public function update(Request $request, Device $device)
    {
        $device->update($request->only(['name', 'uniqueid', 'model']));
        $device = Device::find($device->id);
        return new DeviceResource($device);
    }

    /**
     * Remove the specified device.
     * @group  Devices
     */
    public function destroy(Device $device)
    {
        $device->delete();
        return response()->json([
            'message'=>'Deletes successfully'
        ], 204);
    }
}
