<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class AdminMiddleware
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

        if(($path == 'admin_login' || $path == 'admin-register') && Session :: get('admin_name')){

            return redirect('admin/home');

        } else if($path != '/' && ($path != 'admin_login' && !Session :: get('admin_name')) &&
            ( $path != 'admin-register' && !Session :: get('admin_name'))){
            
            return redirect('admin_login');

        }

        return $next($request);

    }
}
