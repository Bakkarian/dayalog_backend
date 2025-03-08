<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Dispatch;
use App\Models\Order;
use App\Models\OrderVehicle;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;


class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        

        $selectedOrder = request()->query('order_id');

        if ($selectedOrder) {
            $order = Order::with([
                'to',
                'from',
                'orderVehicles.dispatches',
                'orderVehicles.vehicle.driver.bioData',
                'orderVehicles.vehicle.vehicleDevice.device'
            ])->find($selectedOrder);
        }

        if (auth()->user()->can('orders.view')) {
            $orders = Order::with(['to','from']);
        } else {
            $orders = Order::with(['to','from'])->where('created_by', operator: auth()->user()->id);
        }

        $orders =  $orders->latest()->paginate(5);



        return Inertia::render('Orders', [
             'orders2' => $orders,
             'selectedOrder' => $order ?? false,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        return Inertia::render( 'CreateOrder');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //TODO: make api and web share all requests
        //TODO: write tests
        $validated = $this->validate($request, [
            'from' => 'required|exists:users,id',
            'to' => 'required|exists:users,id',
            'notes' => 'nullable|string',
            'orderItems' => 'required|array|min:1',
            'singleShipment' => ['required','boolean'],
            'singleShipmentOrigin' => ['required_if:singleShipment,true'],
            'singleShipmentDestination' => ['required_if:singleShipment,true'],
            'vehicleSelected' => ['required','boolean'],
            'vehicle_id' => ['required_if:vehicleSelected,true,exists:vehicles,id'],
        ]);

        $uuid =  ( Str::uuid())->toString();

        $order = (new OrderService())->store([
            ...$request->only(['from','to','notes']),
            'items' => $request->input('orderItems'),
            'reference' =>  $uuid,
            'payload' => json_encode($request->all()),
            'created_by' => auth()->user()->id,
       ]);

       $order->organizations()->attach(session()->get('organization_id'));

       if($validated['singleShipment']){
            if($validated['vehicleSelected']){

                $orderVehicle = OrderVehicle::firstOrCreate([
                    'order_id' => $order->id,
                    'vehicle_id' => $request->vehicle_id,
                ]);

                //add a dispatch (a trip)
                $orderVehicle->dispatches()->create([
                    'origin' => $request->singleShipmentOrigin,
                    'destination' => $request->singleShipmentDestination,
                    'notes' => $request->notes ?? '',
                ]);

            }else{
                $order->trips()->create([
                    'origin'=> $request->singleShipmentOrigin,
                    'destination'=> $request->singleShipmentDestination,
                    'notes' => $request->notes ?? '',
                ]);
            }
       }



       return redirect()->route('orders', ['order'=> $order->id])->with('success', 'Order Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Order Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function addTrip(Request $request, Order $order)
    {

        //vehicle_id is required
        $validated = $this->validate($request, [
            'vehicleSelected' => 'required|boolean',
            'vehicle_id' => 'exists:vehicles,id',
            'origin' => 'required|string',
            'destination' => 'required|string',
        ]);
        if($validated['vehicleSelected']){

            $orderVehicle = OrderVehicle::firstOrCreate([
                'order_id' => $order->id,
                'vehicle_id' => $request->vehicle_id,
            ]);

            //add a dispatch (a trip)
            $orderVehicle->dispatches()->create([
                'origin' => $request->origin,
                'destination' => $request->destination,
                'notes' => $request->notes ?? '',
            ]);
        }else{
            $order->trips()->create([
                'origin'=> $request->origin,
                'destination'=> $request->destination,
                'notes' => $request->notes ?? '',
            ]);
        }

        return redirect()->route('orders', ['order_id'=> $order->id])->with('success', 'Trip Added');
    }

    public function updateTrip(Request $request, Dispatch $dispatch)
    {
        $this->validate($request, [
            'status' => 'required'
        ]);

        $dispatch->status = $request->status;
        $dispatch->save();

        return redirect()->back()->with('success', 'Trip Updated');
    }
    public function orderMap(Request $request,  $order)
    {

        $order =  Order::with([
            'orderVehicles.vehicle.vehicleDevice.device',
            'orderVehicles.vehicle.driver.bioData',
            'orderVehicles.dispatches'
        ])->find($order);

        $devices = $order->orderVehicles->map(function ($orderVehicle){
            $device = $orderVehicle->vehicle()->with(['device'])->first()->device;
            $lastPosition = $device->lastPosition;
            $device->lastPosition = $lastPosition;
            return $device;
        });

        $dispatches = $order->orderVehicles->flatMap(function ($orderVehicle) {
            return $orderVehicle->dispatches;
        });


       if(isset($request->dispatch)){
            $selectedDispatch = Dispatch::with([
                'orderVehicle.vehicle.vehicleDevice.device',
                'orderVehicle.vehicle.driver.bioData',
                'deviceEvents',
                'devicePositions',
            ])->find($request->dispatch);
            $selectedDispatch->stops = $selectedDispatch->getStops();
        }



        return Inertia::render('OrderMap', [
            'order' => $order,
            'devices' => $devices,
            'dispatches' => $dispatches,
            'selectedDispatch' => $selectedDispatch ?? null,
        ]);
    }
}
