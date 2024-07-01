<?php

use App\Http\Controllers\Auth\API\AuthenticatedSessionController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DevicePositionController;
use App\Http\Controllers\DispatchController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\VehiclesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


/**
 * @group Users
 */
Route::middleware(['auth:sanctum'])->get('/user', [AuthenticatedSessionController::class, 'index']);

Route::apiResource('devices', DeviceController::class);
Route::get('devices/{device}/positions', [DevicePositionController::class, 'index']);

Route::apiResource('drivers', DriverController::class);
Route::post('/drivers/{driver}/vehicles/{vehicle}', [DriverController::class, 'assignVehicle']);
Route::delete('/drivers/{driver}/vehicles/{vehicle}', [DriverController::class, 'removeVehicle']);

Route::apiResource('vehicles', VehiclesController::class);
Route::put('vehicles/{vehicle}/attach-device', [VehiclesController::class, 'attachDevice']);
Route::put('vehicles/{vehicle}/detach-devices', [VehiclesController::class, 'detachDevices']);

Route::apiResource('orders', OrderController::class);
Route::post('/orders/{order}/vehicle/{vehicle}', [OrderController::class, 'attachVehicle']);
Route::delete('/orders/{order}/vehicle/{vehicle}', [OrderController::class, 'detachVehicle']);
Route::put('/orders/{order}/status/{newStatus}', [OrderController::class, 'changeStatus']);

Route::apiResource('dispatches', DispatchController::class);
Route::put('/dispatches/{dispatch}/status/{newStatus}', [DispatchController::class, 'changeStatusOfAnOrder']);


require __DIR__.'/api_auth.php';
