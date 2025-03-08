<?php

namespace App\Helpers\Traits;

use App\Models\DevicePosition;

trait Dispatch
{

    public function getDevicePositions()
    {
        $deviceId = $this->orderVehicle->vehicle->vehicleDevice->device_id ?? null;

        $positions = DevicePosition::where('deviceid', $deviceId)
                                      ->whereBetween('fixtime' , [
                                            $this->dispatched_at , 
                                            $this->delivered_at  ?? $this->cancelled_at ?? now()                                    
                                        ] )
                                        ->orderBy('id', 'desc')->get();
        return $positions;

    }


    public function getStops($minSpeed = 0.2, $maxDuration = 0.1 )
    {
        $deviceId = $this->orderVehicle->vehicle->vehicleDevice->device_id ?? null;

        $positions = DevicePosition::where('deviceid', $deviceId)
                                      ->whereBetween('fixtime' , [
                                            $this->dispatched_at , 
                                            $this->delivered_at  ?? $this->cancelled_at ?? now() 
                                        ] )
                                        ->orderBy('id', 'desc')->get();
        
        $stops = [];
        $currentStop = null;

        foreach ($positions as $position) {
            if ($position['speed'] <= $minSpeed) {

                if ($currentStop === null) {

                    $currentStop = [
                        'start' => $position,
                        'end' => $position,
                        'duration' => 0,
                    ];

                } else {

                    $currentStop['end'] = $position;
                    $currentStop['duration'] = strtotime($position['fixtime']) - strtotime($currentStop['start']['fixtime']);
                }
            } else {

                if ($currentStop !== null) {
                    //push the previous stop  to stops if the duration was actually greater
                    if ($currentStop['duration'] >= $maxDuration) {
                        $stops[] = $currentStop;
                    }

                    $currentStop = null;
                }

            }
        }

        if ($currentStop !== null && $currentStop['duration'] >= $maxDuration) {
            $stops[] = $currentStop;
        }

        return $stops;
    }


    /**
     *
     * Returns the distance covered on a dispatch in meters
     *
     */

    public function getDistance()
    {
        $devicePositions = $this->devicePositions();
        $start_position = $devicePositions->first();
        $last_position = $devicePositions->latest()->first();
        return json_decode($last_position->attributes["attributes"])->totalDistance -  json_decode($start_position->attributes["attributes"])->totalDistance;
    }

}
