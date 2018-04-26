<?php

namespace App\Http\Middleware;

use Closure;
use App\Role;
use Auth;

class Admin
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

        if( Auth::check() && ((Role::find(Auth::user()->role_id)->name == 'Admin' )|| (Role::find(Auth::user()->role_id)->name == 'Staff' ) || (Role::find(Auth::user()->role_id)->name == 'SuperAdmin' )))
            {
                return $next($request);
            }
                return redirect()->guest('/home');
    }
}
