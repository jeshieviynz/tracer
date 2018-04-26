<?php

namespace App\Http\Middleware;

use Closure;
use App\Role;
use Auth;

class alumni
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

        if( Auth::check() && (Role::where('id', Auth::user()->role_id)->first()->name == 'Alumni'))
            {
                return $next($request);
            }
            return redirect()->guest('/alumnisurvey');
    
    }
}
