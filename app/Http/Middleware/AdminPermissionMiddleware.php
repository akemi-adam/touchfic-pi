<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use App\Enums\UserRole;
use Auth, Closure, Gate, Logger, URL;

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
        if (Gate::denies('admin_operations')) {

            Logger::log('admin', 'warning', ' there was an attempt to access the route: ' . URL::current());

            abort(403);
            
        }

        Logger::log('admin', 'info', Auth::user()->name . ' has accessed the route: ' . URL::current());

        return $next($request);
    }
}
