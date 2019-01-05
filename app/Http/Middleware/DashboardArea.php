<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class DashboardArea
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

        if ( ! Auth::check()){
            return redirect()->guest(route('login'))->with('error', trans('app.unauthorized_access'));
        }

        return $next($request);
    }
}
