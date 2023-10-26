<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDispatchedDeviceEventsRequest;
use App\Http\Requests\UpdateDispatchedDeviceEventsRequest;
use App\Models\Dispatch;
use App\Models\DispatchedDeviceEvents;
use Exception;

class DispatchedDeviceEventsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDispatchedDeviceEventsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DispatchedDeviceEvents $dispatchedDeviceEvents)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DispatchedDeviceEvents $dispatchedDeviceEvents)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDispatchedDeviceEventsRequest $request, DispatchedDeviceEvents $dispatchedDeviceEvents)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DispatchedDeviceEvents $dispatchedDeviceEvents)
    {
        //
    }


    public function processTraccarPosition($position){

        $deviceId = $position->deviceId;

        $dispatch = Dispatch::with(['deviceEvents', 'orderVehicle.vehicle.device' => function ($q) use ($deviceId) {
                $q->where('devices.id', $deviceId);
            }
        ])
            ->where('status', 'transit')
            ->latest()
            ->first();

        if ($dispatch) {
            if ($dispatch->deviceEvents->isEmpty()) {
                if($position->speed > 0.2 ){
                    DispatchedDeviceEvents::create([
                        'dispatch_id' => $dispatch->id,
                        'device_id' => $deviceId,
                        'device_position_id' => $position->id,
                        'status' => 'started'
                    ]);
                }
            } else {

                $event = $dispatch->deviceEvents()->with('devicePosition')->latest()->first();
                $lastDevicePosition = $event->devicePosition;
                if ($this->calculatePercentage($lastDevicePosition->speed, $position->speed) > 30 ){

                    DispatchedDeviceEvents::create([
                        'dispatch_id' => $dispatch->id,
                        'device_id' => $deviceId,
                        'device_position_id' => $position->id,
                        'status' => ($position->speed < 0.2 ) ? "stopped" : (($lastDevicePosition->speed < 0.3 ) ?  "started" : "moving")
                    ]);
                }
            }
        }


    }

    function calculatePercentage($original, $given)
    {
        try{
            $percentageOfGiven = round((abs(($given- $original))*100) / ($original + $given));
        }catch(\DivisionByZeroError $e){
           return 0;
        }

        return $percentageOfGiven;
    }

}
