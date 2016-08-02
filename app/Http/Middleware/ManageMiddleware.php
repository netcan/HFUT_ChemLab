<?php

namespace App\Http\Middleware;

use Closure;
use Gate;

class ManageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Gate::denies('manage'))
            abort(403);
        return $next($request);
    }
}
