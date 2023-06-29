<?php

namespace App\Http\Controllers\Web;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleRequest;
use App\Models\Device;
use App\Services\VehicleService;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        $free_devices = Device::with('vehicle')->whereDoesntHave('vehicle')->get();
        return Inertia::render('AddVehicle', [
            'devices' => $free_devices,
        ]);
    }

    public function store(VehicleRequest $request)
    {
        $vehicle = (new VehicleService())->store($request->validated());

        return redirect()->back()->with('success', 'Added Vehicle');
    }
}
