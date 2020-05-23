<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class superAdmin
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
        if (Auth::check() && Auth::user()->email == "wvanye@gmail.com" || Auth::user()->email == "ctkruger@gmail.com") {
            return $next($request);
        }

    }
}
