<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleRequest;
use App\Http\Resources\VehicleResource;
use App\Models\Device;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehiclesController extends Controller
{
    /**
     * Display a listing of the vehicles.
     *
     * @group Vehicles
     */
    public function index()
    {
        return VehicleResource::collection(Vehicle::paginate(25));
    }

    /**
     * Add vehicle to the system
     *
     * @group Vehicles
     */
    public function store(VehicleRequest $request)
    {
        $device = Vehicle::create([
            'vin' => $request->vin,
            'number_plate' => $request->number_plate,
            'make' => $request->make,
            'model' => $request->model,
            'capacity_weight' => $request->capacity_weight,
            'capacity_volume' => $request->capacity_volume,
            'insurance_policy_number' => $request->insurance_policy_number,
            'insurance_coverage' => $request->insurance_coverage,
            'insurance_expiration' => $request->insurance_expiration
        ]);

        return new VehicleResource($device);
    }

    /**
     * Get vehicle details
     *
     * @group Vehicles
     */
    public function show(Vehicle $vehicle)
    {
        return new VehicleResource($vehicle);
    }

    /**
     * Update vehicle information.
     *
     * @group Vehicles
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $vehicle->update($request->only([
            'make',
            'model',
            'capacity_weight',
            'capacity_volume',
            'availability',
            'insurance_policy_number',
            'insurance_coverage',
            'insurance_expiration',
        ]));
        return new VehicleResource($vehicle);
    }

    /**
     * Delete a vehicle.
     *
     * @group Vehicles
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return response()->json([
            'message'=>'Deletes successfully'
        ], 204);
    }


    /**
     * Attach device to a vehicle
     *
     * @group Vehicles
     */
    public function attachDevice(Request $request, Vehicle $vehicle){

        $request->validate([
            'device_id' => 'required|exists:traccar.tc_devices,id|unique:vehicle_devices,device_id',
        ]);

        $device = Device::findOrFail($request->device_id);
        $vehicle->device()->associate($device);
        $vehicle->save();

        return response()->json(['message' => 'Device attached to the vehicle successfully']);
    }

    /**
     * Remove device attached to a vehicle.
     *
     * @group Vehicles
     */
    public function detachDevice(Request $request, Vehicle $vehicle)
    {

        $vehicle->device()->detach();
        return response()->json(['message' => 'Device successfully detached from the vehicle'], 200);
    }
}
