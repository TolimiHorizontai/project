<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware;

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
        //kadangi niekaip po to negaliu pasiekti all users, tai uzkomentuoju
       // if(Auth::check()){
         //   if(Auth::user()->isAdmin()){
         //       return $next($request);
         //   }
       // }
       // return redirect('/');

       return $next($request);
    }
}
