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
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param mixed ...$roles
     * @return \Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {

    // Check if the user is logged in

        if (!auth()->check()) {
            abort(401, 'Unauthorized');
         }

        $user = auth()->user();

        // Loop through roles and check if the user has any of the specified roles

        foreach ($roles as $role) {
            if ($user->hasRole($role)) {
                return $next($request); // Continue request if user has any required role
            }
        }

       // If the user doesn't have the necessary role

        if(!in_array($user->role, $roles)){
            abort(403, 'Access Denied');
        }

        return $next($request);

    }
}
