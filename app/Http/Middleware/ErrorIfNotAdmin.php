<?php

namespace App\Http\Middleware;

use Closure;

class ErrorIfNotAdmin
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
        if ($request->user()->username !== 'admin') {
            return abort(404);
        }

        return $next($request);
    }
}
