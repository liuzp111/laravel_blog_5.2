<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class AdminLogin
 * @package App\Http\Middleware
 * anthor:liuzp111
 */
class AdminLogin
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
//        echo session('key');
//        echo 12;
        if(!session('admin')){
            return redirect('admin/login');
        }
        return $next($request);
    }
}
