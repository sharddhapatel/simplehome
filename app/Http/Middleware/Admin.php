<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Session;
use Closure;

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
        if(Session::has('admin_id'))
        {
            // echo Session::get('user_id');
            // die();
            return $next($request);
        }
        return redirect('adminlogin')->with('message','Please Login First');
    }
}
