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
                'orderVehicles.vehicle.device'
            ])->find($selectedOrder);
        }

        $orders = Order::with(['to','from'])->paginate();


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
        $this->validate($request, [
            'from' => 'required|exists:users,id',
            'to' => 'required|exists:users,id',
            'notes' => 'nullable|string',
            'orderItems' => 'required|array|min:1',
        ]);


        $uuid =  ( Str::uuid())->toString();


        $order = (new OrderService())->store([
            ...$request->only(['from','to','notes']),
            'items' => $request->input('orderItems'),
            'reference' =>  $uuid,
            'payload' => json_encode($request->all()),
       ]);

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
        $this->validate($request, [
            'vehicle_id' => 'required|exists:vehicles,id',
            'origin' => 'required|string',
            'destination' => 'required|string',
        ]);

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

        $order =  Order::with(['orderVehicles.vehicle.device.lastPosition'])->find($order);
        
        return Inertia::render('OrderMap', [
            'order' => $order,
        ]);
    }
}
