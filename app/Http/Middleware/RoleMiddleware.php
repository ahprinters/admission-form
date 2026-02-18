<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {

    //Not logged in
        if (!auth()->check()) {
            abort(401, 'Unauthorized');
         }

        $user = auth()->user();

        //Role not allowed
        if(!in_array($user->role, $roles)){
            abort(403, 'Access Denied');
        }

        return $next($request);

    }
}
