<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeviceRequest;
use App\Models\Device;
use App\Services\DeviceService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DeviceController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(Request $request)
    {
        $devices = Device::paginate(10);
        return Inertia::render('ViewDevices', [
            'devices' => $devices
        ]);
    }


    public function create()
    {
        return Inertia::render('AddDevice');
    }

    public function store(DeviceRequest $request)
    {
       $device = (new DeviceService())->store($request->validated());

       return redirect()
           ->back()
           ->with('success', 'Device Saved Successfully');
    }


}
