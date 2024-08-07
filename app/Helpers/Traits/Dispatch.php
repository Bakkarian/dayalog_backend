<?php

namespace App\Helpers\Traits;

trait Dispatch
{


    public function getStops($minSpeed = 0.2, $maxDuration = 2 )
    {

        $positions = $this->devicePositions;
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
