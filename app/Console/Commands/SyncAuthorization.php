<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class SyncAuthorization extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-authorization';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $permissions = config('custom.permissions');
        $roles = config('custom.roles');
        $permissionList = array_keys($permissions);

        foreach ($permissionList as $permission) {
            Permission::updateOrCreate(['name' => $permission]);
        }
        
        foreach ($roles as $roleName => $roleData) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        Permission::all()->each(function ($permission) use ($permissions) {
            // dd($permissions[$permission->name]['allowed']);
           $permission->syncRoles($permissions[$permission->name]['allowed'] ?? []); 
        });

    }
}
