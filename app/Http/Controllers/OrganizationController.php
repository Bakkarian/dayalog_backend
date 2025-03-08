<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrganizationController extends Controller
{
    

    public function create()
    {
        return Inertia::render('Organization/Create');
    }

    public function store(Request $request){
        
        $request->validate([
            'name' => 'required'
        ]);


        if ($request->user()->ownedOrganizations()->exists()) {
            return redirect()->route('dashboard')->withErrors('You can only create one organization.');
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

        return redirect()->route('dashboard');
    }
    public function select()
    {
        return Inertia::render('Organization/Select');
    }

    public function storeSelection(Request $request, Organization $organization){
        $request->session()->put('organization_id', $organization->id); 
        return redirect()->route('dashboard');
    }
}
