<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        if (Auth::check() == true){
            $user_type = Auth::user()['user_type'];
            if($user_type=='Admin'){
                return $next($request);
            }else{
                 return redirect(route('admin_login'));
            }
        }else{
             return redirect(route('admin_login'));
        }
        return $next($request);
    }
}
