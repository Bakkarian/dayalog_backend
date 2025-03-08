<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{


    public function index()
    {
        return response()->json(request()->user()->organizations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        
        $request->validate([
            'name' => 'required'
        ]);


        if ($request->user()->ownedOrganizations()->exists()) {
            return response()->json(['message' => 'You can only create one organization.'], 422);             
        }



        $organization = $request->user()->ownedOrganizations()->create([
            'name' => $request->name,
            'slug' => str()->slug($request->name).'-' . $request->user()->id,
        ]);

        $request->user()->organizations()->attach($organization);

        //Set as current organization in sesstion
        $request->session()->put('organization_id', $organization->id); 

        setPermissionsTeamId($organization->id);
        $request->user()->assignRole('Administrator');
        
        return response()->json($organization);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
