<?php

namespace App\Http\Middleware;

use App\Helper\Auth;
use Closure;
use Illuminate\Support\Facades\Redis;

class CheckAuth
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
        $user = Auth::get($request->header('Token'));
        if (!$user) {
            return response()->json(['code' => 401, 'message' => '用户不存在']);
        }

        if ($user->type == 0) {
            return response()->json(['code' => 401, 'message' => '没有权限']);
        }
        return $next($request);
    }
}
