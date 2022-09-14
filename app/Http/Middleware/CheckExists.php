<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $model)
    {
        if (isset($request->post)) {
            if (!$model::find($request->post) ? true : false) {
                abort(404);
            }
        }
        
        if (isset($request->storie)) {
            if (!$model::find($request->storie) ? true : false) {
                abort(404);
            }
        }

        if (isset($request->id)) {
            if (!$model::find($request->id) ? true : false) {
                abort(404);
            }
        }

        if (isset($request->user)) {
            if (!model::find($request->user->id) ? true : false) {
                abort(404);
            }
        }

        return $next($request);
    }
}
