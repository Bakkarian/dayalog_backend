<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\DriverRequest;
use App\Http\Resources\DriverWebJsonResource;
use App\Models\Driver;
use App\Services\DriverService;
use App\Services\UserService;
use Illuminate\Http\Request;
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

       (new DriverService())->store([
            ...$request->input(),
            'user_id' =>  $user->id
       ]);

       return redirect()
           ->back()
           ->with('success', 'Driver added Successfully');
    }

    public function search(Request $request)
    {
        $term = $request->term;

        $drivers = Driver::with(['bioData'])->where('license', 'LIKE', '%'.$term.'%')
                    ->orWhereHas('bioData', function ($q) use ($term){
                        return $q->where('name', 'LIKE' , '%'.$term.'%')
                               ->orWhere('email', 'LIKE', '%'.$term.'%' )
                               ->orWhere('patasente_id', 'LIKE', '%'.$term.'%' );
                    })
                    ->limit(10)->get();

        return DriverWebJsonResource::collection($drivers);
    }
}
