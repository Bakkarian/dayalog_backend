<?php

namespace App\Http\Controllers;

use App\Http\Resources\HomeDriversResource;
use App\Models\Driver;
use Inertia\Inertia;

class HomeController extends Controller
{



    public function index()
    {
        return Inertia::render('Dashboard');
    }


    public function drivers()
    {
        $drivers = Driver::with(['vehicles.dispatches', 'bioData'])->get();
        return response()->json(HomeDriversResource::collection($drivers));
    }
}
