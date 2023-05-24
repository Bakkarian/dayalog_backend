<?php

namespace App\Http\Controllers;

use App\Http\Requests\DriverRequest;
use App\Http\Resources\DriverResource;
use App\Models\Driver;
use Illuminate\Http\Request;

/**
* @group Drivers
*/
class DriverController extends Controller
{
    /**
     * Display a listing of the drivers.
     */
    public function index()
    {
        return DriverResource::collection(Driver::paginate(25));
    }

    /**
     * Store a newly created drivers.
     */
    public function store(DriverRequest $request)
    {
        $driver = Driver::create([
            'user_id' => $request->user_id,
            'license' => $request->license,
        ]);

        return new DriverResource($driver);
    }

    /**
     * Display the specified resource.
     */
    public function show(Driver $driver)
    {
        return new DriverResource($driver);
    }

    /**
     * Update the specified driver.
     */
    public function update(Request $request, string $driver)
    {
        $request->merge(['driver' => $request->route('driver')]);
        $request->validate([
            'driver' => 'exists:drivers,id',
            'user_id' => 'exists:users,id'
        ]);

        $driver = Driver::findOrFail($driver);
        $driver->update($request->only([
            'user_id',
            'license',
        ]));
        return new DriverResource($driver);
    }

    /**
     * Remove driver from the system.
     */
    public function destroy(Driver $driver)
    {
        $driver->delete();
        return response()->json([
            'message'=>'Deletes successfully'
        ], 204);
    }
}
