<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\DriverRequest;
use App\Models\User;
use App\Models\UserMeta;
use App\Services\UserService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10);
        return Inertia::render('UserManagment/Index',[
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::with(['permissions','roles'])->find($id);
        $roles = Role::with(['permissions'])->get();
        $permissions = Permission::all();
        $roles->each(function ($role) use ($permissions) {
            if ($role->name == 'Super User') {
                unset($role->permissions);
                $role->permissions = $permissions;
            }
        });

        $roles->each(function ($role) use ($permissions) {
            if ($role->name == 'Super User') {
                $role->permissions = $permissions;
            }
        });

        $userMeta = UserMeta::getAllUserMeta($user->id);

        return Inertia::render('UserManagment/Edit',[
            'user' => $user,
            'roles' => $roles,
            'permissions' => $permissions,
            'user_meta' => $userMeta,
            'addresses' => config('address'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $user->update($request->all());
        $user->syncRoles($request->roles);
        $user->syncPermissions($request->permissions);


        $user_meta = $request->user_meta;

        foreach ($user_meta as $key => $value) {
            UserMeta::updateMeta($user->id, $key, $value);
        }


        return redirect()
            ->back()
            ->with('success', 'User updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function createClient()
    {
        return Inertia::render('UserManagment/CreateClient');
    }

    public function storeClient(DriverRequest $request)
    {
        
       $user = (new UserService)->firstOrCreate($request->validated());


       $user->organizations()->attach(session()->get('organization_id') ?? getPermissionsTeamId() );
       $user->assignRole('client');


       return redirect()
           ->back()
           ->with('success', 'Client added Successfully');

    }


}
