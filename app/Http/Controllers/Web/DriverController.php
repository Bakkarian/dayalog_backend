<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\DriverRequest;
use App\Services\DriverService;
use App\Services\UserService;
use Inertia\Inertia;

class DriverController extends Controller
{
    public function create()
    {
        return Inertia::render('CreateDriver');
    }

    public function store(DriverRequest $request)
    {

       $user = (new UserService())->store($request->validated());

       $driver = (new DriverService())->store([
            ...$request->input(),
            'user_id' =>  $user->id
       ]);

       return redirect()
           ->route('driver.create')
           ->with('success', 'Device Saved Successfully');
    }
}
