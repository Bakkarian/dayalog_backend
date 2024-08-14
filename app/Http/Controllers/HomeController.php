<?php

namespace App\Http\Controllers;

use App\Http\Resources\HomeDriversResource;
use App\Models\Device;
use App\Models\DevicePosition;
use App\Models\Driver;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{



    public function index(Request $request)
    {

        $devices = Device::with(['vehicle'])->get();

        $devices->map(function ($device){
          $device->last_position =  DevicePosition::where('deviceid', $device->id )->orderBy('id', 'desc')->first();
          return $device;
        });

        $selectedDriverId =  $request->driver;
        if($selectedDriverId){
            $driver = Driver::with([
                'vehicles.device',
                'vehicles.dispatches.stops.devicePosition',
               'dispatchedVehicle.latestActiveDispatch.stops.devicePosition'
            ])->findOrFail($selectedDriverId);
        }

        if($request->device){
            $device = $devices->where('id', $request->device)->first();
        }

        if($request->history){
            // "historyFrom" => "2024-8-6 00:00:00"
            //  "historyTo" => "2024-8-6 19:4:24"
            $positions = $device->positions()
                                ->whereBetween('devicetime', [  /* Carbon::parse($request->historyFrom ) */ Carbon::now()->subMinutes(181),/* Carbon::parse($request->historyTo)*/ Carbon::now() ])
                                ->latest()
                                    ->get();

            // dd($request->all() ,$positions);
        }

        return Inertia::render('Dashboard', [
            'devices' => $devices,
            'drivers' => fn() => $this->drivers(),
            'driver' => $driver ?? null,
            'device' => $device ?? null,
            'history' => $request->history ?? 0,
            'historyPositions' => $positions ?? null,
            'currentHistoryPosition' => $request->historyPosition ?? 0
        ]);
    }


    public function drivers()
    {
        $drivers = Driver::with(['vehicles.dispatches', 'bioData'])->get();
        return response()->json(HomeDriversResource::collection($drivers));
    }
}
