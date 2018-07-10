<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guard()) {
            if ($request->ajax() || $request->wantsJson()) {
                return redirect()->guest('/login/l');
            } else {

                return response('Unauthorized.', 401);
            }
        }
       return $next($request);

    }
}
