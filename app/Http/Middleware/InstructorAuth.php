<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class InstructorAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!session()->has('InstructorEmail'))
        {
            return redirect('/instructor/login');
        }
        return $next($request);
    }
}
