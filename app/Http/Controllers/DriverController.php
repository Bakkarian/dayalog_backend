<?php

namespace App\Http\Controllers;

use App\Http\Requests\DriverRequest;
use App\Http\Resources\DriverResource;
use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return DriverResource::collection(Driver::paginate(25));
    }

    /**
     * Store a newly created resource in storage.
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
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
