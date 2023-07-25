<?php

use App\Http\Controllers\Web\DeviceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\DriverController;
use App\Http\Controllers\Web\VehicleController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test_page', function () {
    return Inertia::render('Test', [
    ]);
})->name('test');

Route::get('/', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/create-driver',  [DriverController::class,'create'] )->middleware(['auth', 'verified'])->name('driver.create');
Route::post('/create-driver', [DriverController::class,'store'] )->middleware(['auth', 'verified'])->name('driver.store');

Route::get('/view-devices', [DeviceController::class, 'index'])->middleware(['auth', 'verified'])->name('devices.index');
Route::get('/add-device', [DeviceController::class, 'create'])->middleware(['auth', 'verified'])->name('device.create');
Route::post('/device/store', [DeviceController::class, 'store'])->middleware(['auth', 'verified'])->name('device.store');


Route::get('/vehicles',  [VehicleController::class, 'index'])->middleware(['auth', 'verified'])->name('vehicle.view');
Route::get('/add-vehicle', [VehicleController::class, 'create'])->middleware(['auth', 'verified'])->name('vehicle.create');
Route::post('/vehicle/store', [VehicleController::class, 'store'])->middleware(['auth', 'verified'])->name('vehicle.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
