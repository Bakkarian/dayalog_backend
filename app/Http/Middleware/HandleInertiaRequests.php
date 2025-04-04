<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Spatie\Permission\Models\Permission;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {

        

        if(auth()->check()&& session()->has('organization_id')  ) {
            setPermissionsTeamId(session()->get('organization_id'));
        }else{
            session()->forget('organization_id');
            setPermissionsTeamId(null);
        }

        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
                'organizations' => $request->user() ? $request->user()->organizations()->get() : [],
                'permissions' =>    $request->user() ? Permission::all()->filter(function ($permision){
                    return auth()->user()->can($permision->name);
                  })->pluck('name')->values()->toArray() : [],
            ],
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
            'csrf_token' => csrf_token(),
            'flash' => function () use ($request) {
                return [
                    'error' => $request->session()->get('error'),
                    'success' => $request->session()->get('success'),
                    'message' => $request->session()->get('message'),
                    'warning' => $request->session()->get('warning'),
                    'info' => $request->session()->get('info'),
                    'actions' => $request->session()->get('actions'),
                ];
            }
        ]);
    }
}
