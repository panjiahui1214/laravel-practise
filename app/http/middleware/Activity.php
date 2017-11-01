<?php
// artisan创建命令：php artisan make:middleware Activity
namespace App\Http\Middleware;

use Closure;

class Activity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    /* 中间件前置操作（在请求之前） */
//    public function handle($request, Closure $next)
//    {
//        if(time() < strtotime('2017-10-01')) {
//            return redirect('activity0');
//        }
//        return $next($request);
//    }

    public function handle($request, Closure $next)
    {
        $response = $next($request);
        var_dump($response);
        echo  "我是中间件后置操作";
        return $next($request);
    }
}
