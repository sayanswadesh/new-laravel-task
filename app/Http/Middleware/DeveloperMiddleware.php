<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeveloperMiddleware
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
        if (Auth::check() == true){
            $user_type = Auth::user()['user_type'];
            if($user_type=='Developer'){
                return $next($request);
            }else{
                 return redirect(route('developer_login'));
            }
        }else{
             return redirect(route('developer_login'));
        }
        return $next($request);
    }
}
