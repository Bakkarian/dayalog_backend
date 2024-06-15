<?php

namespace App\Http\Controllers;

use App\Http\Resources\DevicePositionResource;
use App\Models\DevicePosition;
use Illuminate\Http\Request;

class DevicePositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $device)
    {
        $validatedData = $request->validate([
            'from' => 'required|date|date_format:Y-m-d H:i:s',
            'to' => 'required|date|date_format:Y-m-d H:i:s',
        ]);

        $from = date($validatedData['from']);
        $to = date($validatedData['to']);

        $devices =  DevicePosition::where('deviceid', $device)->whereBetween('servertime', [$from, $to])->get();

        return DevicePositionResource::collection($devices);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
