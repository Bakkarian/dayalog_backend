<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TestController extends Controller
{


    public function client(){

        $orders = Order::where('to', auth()->id())
                            ->orWhere('from', auth()->id())->latest()
                            ->orWhere('created_by', auth()->id())
                            ->get();


        if(request()->selectedOrder){
            $selectedOrder = Order::with([
                'to',
                'from',
                'trips',
                'orderVehicles.vehicle',
                'orderVehicles.dispatches',
                'orderVehicles.activeDispatches'
            ])->find(request()->selectedOrder);
        }



        return Inertia::render( 'ClientDashboard', [
            'orders' => $orders,
            'selectedOrder' => $selectedOrder ?? null
        ] );
    }
    public function clientCreatePackage(){
        return Inertia::render( 'ClientCreatePackage' );
    }
}
