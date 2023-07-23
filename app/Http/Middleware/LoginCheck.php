<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LoginCheck
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
        if(!session()->has('adminData')){
            session()->flash('message', 'You have no access to enter<strong>!');
            session()->flash('message_class', 'danger');
            return redirect('/');
        }
        return $next($request);
    }
}
