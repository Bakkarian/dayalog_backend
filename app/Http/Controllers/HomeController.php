<?php

namespace App\Http\Controllers;

use App\Http\Resources\HomeDriversResource;
use App\Models\Device;
use App\Models\Driver;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{



    public function index(Request $request)
    {

        $devices = Device::with(['vehicle'])->get();


        $selectedDriverId =  $request->driver;
        if($selectedDriverId){
            $driver = Driver::with([
                'vehicles.device',
                'vehicles.dispatches.stops.devicePosition',
               'dispatchedVehicle.latestActiveDispatch.stops.devicePosition'
            ])->findOrFail($selectedDriverId);
        }

        return Inertia::render('Dashboard', [
            'devices' => $devices,
            'drivers' => fn() => $this->drivers(),
            'driver' => $driver ?? null
        ]);
    }


    public function drivers()
    {
        $drivers = Driver::with(['vehicles.dispatches', 'bioData'])->get();
        return response()->json(HomeDriversResource::collection($drivers));
    }
}
