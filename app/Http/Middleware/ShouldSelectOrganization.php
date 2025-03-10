<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShouldSelectOrganization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {


        if ($request->is('api/*') && $request->header('Content-Type') == 'application/json') {
           
            if(!$request->has('org_id')) {
                return response()->json(['message' => 'Please select an organization.'], 409);
            }



            if(auth()->check()){
                auth()->user()->unsetRelation('roles')->unsetRelation('permissions');

                setPermissionsTeamId($request->org_id);
                
                return $next($request);
            }
        }

        if (!$request->session()->has('organization_id')) {
            return redirect()->route('org.select');
        }

        setPermissionsTeamId($request->session()->get('organization_id'));
        
        return $next($request);
    }
}
