<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
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




        return Inertia::render('UserManagment/Edit',[
            'user' => $user,
            'roles' => $roles,
            'permissions' => $permissions
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
