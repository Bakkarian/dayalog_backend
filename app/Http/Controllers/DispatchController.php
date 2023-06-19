<?php

namespace App\Http\Controllers;

use App\Http\Requests\DispatchRequest;
use App\Http\Resources\DispatchResource;
use App\Models\Dispatch;
use Illuminate\Http\Request;

   /**
     * @group Dispatch
     */
class DispatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return DispatchResource::collection(Dispatch::paginate(25));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DispatchRequest $request)
    {
        $dispatch = Dispatch::create([
            'order_vehicle_id'=> $request->order_vehicle_id,
            'origin'=> $request->origin,
            'destination' => $request->destination,
            'notes' => $request->notes
        ]);

        return new DispatchResource($dispatch);
    }

    /**
     * Display the specified resource.
     */
    public function show(Dispatch $dispatch)
    {
        return new DispatchResource($dispatch);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dispatch $dispatch)
    {
        $dispatch->update($request->only([
            'order_vehicle_id',
            'origin',
            'destination',
            'notes'
        ]));
        return new DispatchResource($dispatch);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dispatch $dispatch)
    {
        $dispatch->delete();
        return response()->json([
            'message'=>'Deleted successfully'
        ], 204);
    }

    /**
     * Change status of a dispatch
     *
     * @param Dispatch $dispatch The dispatch model instance
     * @urlParam string $newStatus The new status value (possible values:    'pending',  'in_progress', 'completed'  Example: in_progress
     *
     */

     public function changeStatusOfAnOrder(Dispatch $dispatch, $newStatus)
     {
        $dispatch->status = $newStatus;
        $dispatch->save();

        return response()->json([
            'message' => 'Status updated successfully',
            'status' => $dispatch->status,
        ]);
     }

}
