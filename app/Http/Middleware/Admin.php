<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    private $auth;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      //check if session exists and if user has admin role
      $this->auth =
          auth()->user() ?
              (auth()->user()->role === 'admin')
              : false;

      // pass request if auth is valid
      if($this->auth === true)
          return $next($request);
      //redirect to login route with a flash message
      return redirect()->route('login')->('error', 'Access denied. Login to continue.');
    }
}
