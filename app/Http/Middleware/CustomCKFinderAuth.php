<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class CustomCKFinderAuth
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
        config(['ckfinder.authentication' => function() {
            if(Auth::check() && Auth::user()->is_admin)
            {
                return true;
            }
        }]);
        return $next($request);
    }
}
