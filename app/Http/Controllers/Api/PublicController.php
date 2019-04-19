<?php

namespace App\Http\Controllers\Api;

use App\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

/**
 * Class PublicController
 * @package App\Http\Controllers\Api
 */
class PublicController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse

     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'user_name' => 'required|string',
            'password' => 'required|string',
        ]);
        $user = User::where(['username' => $request->input('user_name'), 'password' => md5(md5($request->input('password')) . User::SALT)])->first();
        if (!$user) {
            return response()->json(['code' => 402, 'message' => '用户名或密码错误']);
        }
        // 创建token
        $token = static::getNonceStr();
        Redis::SET("user:token:{$token}", $user->id, 'NX', 'EX', 60 * 60 * 24);
        return response()->json(['code' => 200, 'message' => 'success', 'data' => ['token' => $token]]);
    }

    public function logout(Request $request)
    {
        Redis::DEL("user:token:{$request->header('Token')}");
        return response()->setStatusCode(201);
    }

    /**
     * 获取随机字符串
     * @param int $length 长度
     * @return string 返回的字符串
     */
    public static function getNonceStr($length = 32)
    {
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }
}