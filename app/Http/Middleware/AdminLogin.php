<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class AdminLogin  中间件
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
        if(!session('user_info')){
            return redirect('admin/login');
        }
        return $next($request);
    }
}
