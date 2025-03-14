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
        if (auth()->user()->can('view.orders')) {
            $orders = Order::paginate(5);
        } else {
            $orders = Order::where('user_id', auth()->user()->id)->paginate(5);
        }

        return OrderResource::collection($orders);
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
        $order->organizations()->attach(getPermissionsTeamId());

        return new OrderResource($order);
    }

    /**
     * Get all details of an order
     */
    public function show( $order)
    {
        $order = Order::findOrFail($order);

        return new OrderResource($order);
    }

    /**
     * Update Update order details.
     */
    public function update(Request $request, $order)
    {
        $order = Order::findOrFail($order);
        $order->update($request->only([
            'from',
            'to',
            'patasente_purchase_order_id',
            'reference',
            'notes',
        ]));
        return new OrderResource($order);
    }

    /**
     * Delete an order.
     */
    public function destroy($order)
    {
        $order = Order::findOrFail($order);
        $order->delete();
        return response()->json([
            'message'=>'Deletes successfully'
        ], 204);
    }


    /**
     * Attach Vehicle to an order
     */
    public function attachVehicle( $order,  $vehicle)
    {
        $order = Order::findOrFail($order);
        $vehicle = Vehicle::findOrFail($vehicle);
        // TODO: To avoid attaching of vehicle to multiple orders or even same order
        $orderVehicle = new OrderVehicle();
        $orderVehicle->order_id = $order->id;
        $orderVehicle->vehicle_id = $vehicle->id;
        $orderVehicle->created_at = now();
        $orderVehicle->updated_at = now();
        $orderVehicle->save();

        return response()->json([
            'message' => 'Vehicle attached successfully.',
            'orderVehicle' => $orderVehicle
        ]);
    }

    /**
     * Detach Vehicle from an order
     */
    public function detachVehicle(  $order,  $vehicle)
    {
        $order = Order::findOrFail($order);
        $vehicle = Vehicle::findOrFail($vehicle);

        $orderVehicle = OrderVehicle::where('order_id', $order->id)
        ->where('vehicle_id', $vehicle->id)
        ->firstOrFail();
        $orderVehicle->delete();

        return response()->json([
            'message' => 'Vehicle detached successfully.'
        ]);
    }

    /**
     * Change Order status
     * @param   Order $order The order model instance
     * @urlParam string $newStatus The new status value (possible values: 'not_started', 'transit', 'reached', 'cancelled').  Example: cancelled
     *
     */

    public function changeStatus( $order, $newStatus)
    {
        $order = Order::findOrFail($order);
        $order->status = $newStatus;
        $order->save();

        return response()->json([
            'message' => 'Status updated successfully',
            'status' => $order->status,
        ]);
    }
}
