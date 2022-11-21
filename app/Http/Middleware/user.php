<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class user
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
       
        if(Session::has('user_id'))
        {
            // echo Session::get('user_id');
            // die();
            return $next($request);
        }
        
            return redirect('userlogin')->with('message','Please Login First');
    }
}
