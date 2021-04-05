<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserMiddleware
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
        $path = $request -> path();

        if(($path == 'user_login' || $path == 'user-register') && Session :: get('author_name')){

            return redirect('user/blog');

        } else if($path != '/' && ($path != 'user_login' && !Session :: get('author_name')) && 
            ( $path != 'user-register' && !Session :: get('author_name')) ){
            
            return redirect('user_login');

        }
        
        return $next($request);

    }
}
