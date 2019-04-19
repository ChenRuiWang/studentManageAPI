<?php

namespace App\Http\Controllers\Api;

use App\Helper\Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function detail(Request $request)
    {
        $user = Auth::get($request->header('Token'));

        return response()->json(['code' => 200, 'message' => 'success', 'data' => $user]);
    }

    public function user(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        User::create($request->all());
        return response()->json(['code' => 200, 'message' => 'success']);
    }

    public function index()
    {
        return User::all();
    }
}
