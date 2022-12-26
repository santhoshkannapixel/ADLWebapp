<?php

namespace App\Http\Middleware;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laracasts\Flash\Flash;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Sentinel::check()== FALSE) {
            return redirect()->route('login');
        }

    if(auth_user_role()->slug != 'admin' && isset(auth_user_role()->permissions)) {
            foreach(auth_user_role()->permissions as $access => $val) {
                if(formatRoute(request()->route()->getName()) == formatRoute($access)) {
                    if($val == 1) {
                        return $next($request);
                    } else {
                        Flash::error('Permission Denied ! Contact your admin');
                        return back();
                    }
                }
            }
        }
        return $next($request);
    }
}
