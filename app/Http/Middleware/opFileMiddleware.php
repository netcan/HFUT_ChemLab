<?php

namespace App\Http\Middleware;

use Closure;
use Gate;

class opFileMiddleware
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
        if(basename($request->url()) === "connector")
            return $next($request);
        else if(Gate::denies('manage'))
            abort(403);
        return $next($request);
    }
}
