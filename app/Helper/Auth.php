<?php

namespace App\Helper;

use Illuminate\Support\Facades\Redis;

class Auth
{
    public static function get($token)
    {
        $id = Redis::get("user:token:{$token}");

        return \App\User::with('student')->find($id);
    }
}
