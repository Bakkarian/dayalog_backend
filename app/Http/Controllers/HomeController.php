<?php

namespace App\Http\Controllers;

use App\Http\Resources\HomeDriversResource;
use App\Models\Driver;
use Inertia\Inertia;

class HomeController extends Controller
{



    public function index()
    {

        $drivers = Driver::with(['vehicles.dispatches', 'bioData'])->get();

        return Inertia::render('Dashboard', [
            'drivers' => HomeDriversResource::collection($drivers),
        ]);
    }
}
