<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;


class Helpers
{
    public static function detectStops($positions)  {


        $positions = $positions->map(function ($position) {
            return [
              "latitude" => $position->latitude,
              "longitude" => $position->longitude,
              "timestamp" => $position->devicetime
            ];
          });

          
        $response = Http::post( "http://app.dayalog.co:5500/detect_stops", $positions);
        
        return $response->json();
    }
}