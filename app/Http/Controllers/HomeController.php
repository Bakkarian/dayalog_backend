<?php

namespace App\Http\Controllers;

use App\Http\Resources\HomeDriversResource;
use App\Models\Device;
use App\Models\Driver;
use Inertia\Inertia;

class HomeController extends Controller
{



    public function index()
    {

        $devices = Device::with(['vehicle'])->get();

        return Inertia::render('Dashboard', [
            'devices' => $devices,
        ]);
    }


    public function drivers()
    {
        $drivers = Driver::with(['vehicles.dispatches', 'bioData'])->get();
        return response()->json(HomeDriversResource::collection($drivers));
    }
}
