<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;

class CheckLogin
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
        if (!$request->header('Token') or !Redis::GET("user:token:{$request->header('Token')}")) {
            return response()->json(['code' => 401, 'message' => '请登录']);
        }
        return $next($request);
    }
}
