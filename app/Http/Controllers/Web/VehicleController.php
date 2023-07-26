<?php

namespace App\Http\Controllers\Web;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleRequest;
use App\Models\Device;
use App\Models\Vehicle;
use App\Services\VehicleService;

class VehicleController extends Controller
{
    public function index(Request $request)
    {

        $vehicles = Vehicle::with(['driver.bioData' ])->paginate(7);
        return Inertia::render('ViewVehicles', [
            'vehicles' => $vehicles
        ]);
    }
    public function create(Request $request)
    {
        $free_devices = Device::with('vehicle')->whereDoesntHave('vehicle')->get();
        return Inertia::render('AddVehicle', [
            'devices' => $free_devices,
        ]);
    }

    public function store(VehicleRequest $request)
    {
        (new VehicleService())->store($request->validated());

        return redirect()->back()->with('success', 'Added Vehicle');
    }
    public function attachDriver(Request $request, Vehicle $vehicle)
    {

        if($vehicle->driver != null ){
            return  redirect()->back()->with('success', 'Vehicle is already attached to a driver.');
        }

        VehicleDriver::create(
            [
                'vehicle_id' => $vehicle->id,
                'driver_id' => $request->driver_id
            ]
        );

        return redirect()->back()->with('success', 'Vehicle updated');
    }
}
