<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class TestController extends Controller
{
    

    public function client(){
        return Inertia::render( 'ClientDashboard' );
    }
}
