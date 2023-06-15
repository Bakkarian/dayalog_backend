<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderVehicle;
use App\Models\Vehicle;
use Illuminate\Http\Request;

/**
 * @group Orders
 */
class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index()
    {
        return OrderResource::collection(Order::paginate(25));
    }

    /**
     * Add an order to the system
     */
    public function store(OrderRequest $request)
    {
        $order = Order::create([
            'from'=> $request->from,
            'to'=> $request->to,
            'patasente_purchase_order_id'=> $request->patasente_purchase_order_id,
            'reference'=> $request->reference,
            'notes'=> $request->notes,
        ]);

        return new OrderResource($order);
    }

    /**
     * Get all details of an order
     */
    public function show(Order $order)
    {
        return new OrderResource($order);
    }

    /**
     * Update Update order details.
     */
    public function update(Request $request, Order $order)
    {
        $order->update($request->only([
            'from',
            'to',
            'patasente_purchase_order_id',
            'reference',
            'notes',
        ]));
        return new Order($order);
    }

    /**
     * Delete an order.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json([
            'message'=>'Deletes successfully'
        ], 204);
    }


    /**
     * Attach Vehicle to an order
     */
    public function attachVehicle(Order $order, Vehicle $vehicle)
    {
        $orderVehicle = new OrderVehicle();
        $orderVehicle->order_id = $order->id;
        $orderVehicle->vehicle_id = $vehicle->id;
        $orderVehicle->created_at = now();
        $orderVehicle->updated_at = now();
        $orderVehicle->save();

        return response()->json([
            'message' => 'Vehicle attached successfully.'
        ]);
    }

    /**
     * Detach Vehicle from an order
     */
    public function detachVehicle( Order $order, Vehicle $vehicle)
    {
        $orderVehicle = OrderVehicle::where('order_id', $order->id)
        ->where('vehicle_id', $vehicle->id)
        ->firstOrFail();
        $orderVehicle->delete();

        return response()->json([
            'message' => 'Vehicle detached successfully.'
        ]);
    }

}
