<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use App\Enums\UserRole;
use Auth, Closure;

class AdminPermissionMiddleware
{
    /**
     * Checks if the user has admin id. If yes, passes the request, if no, returns a status code 403
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * 
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->permission_id === UserRole::ADMIN) {
            return $next($request);
        }
        abort(403);
    }
}
