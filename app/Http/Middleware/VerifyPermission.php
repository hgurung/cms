<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use App\Exceptions\PermissionDeniedException;
use Auth;
class VerifyPermission
{

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param int|string               $permission
     *
     * @throws \App\Exceptions\PermissionDeniedException
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $permission, $guard = null)
    {

        if (Auth::guard($guard)->check() &&
            Auth::guard($guard)->user()->canDo($permission)) {
            return $next($request);
        }

        abort(403);
        //throw new PermissionDeniedException($permission);
    }

}
