<?php

namespace App\Http\Controllers\Api;

use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

/**
 * Class StudentController
 * @package App\Http\Controllers\Api
 */
class StudentController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(['code' => 200, 'message' => 'success', 'data' => Student::all()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|numeric',
            'name' => 'required|string',
            'number' => 'required|numeric',
            'sex' => 'required|in:0,1',
            'nation' => 'required|string',
            'born' => 'required|numeric',
            'cd_card' => 'required|min:18',
            'phone' => 'required|numeric',
            'avatar' => 'mimes:jpeg,png',
            'enter_time' => 'required|numeric',
            'finish_time' => 'required|numeric',
            'edu' => 'required|string',
            'school_name' => 'required|string',
            'major_name' => 'required|string'
        ]);
        $avatar = 'default.jpg';
        if ($request->hasFile('avatar')) {
            $avatar = Storage::url($request->avatar->store('/avatars'));
        }
        $data = $request->all();
        $data['avatar'] = (string) $avatar;

        Student::create($data);

        return response()->json(['code' => 201, 'message' => 'success']);
    }

    /**
     * @param Student $student
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function detail(Student $student, Request $request)
    {
        return response()->json(['code' => 200, 'message' => 'success', 'data' => $student]);
    }


    /**
     * @param Student $student
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Student $student, Request $request)
    {
        if ($request->hasFile('avatar')) {
            $avatar = Storage::url($request->avatar->store('/avatars'));
        }
        $data = $request->all();
        if (isset($avatar)) {
            $data['avatar'] = $avatar;
        } else {
            unset($data['avatar']);
        }
        $student->update($data);
        return response()->json(['code' => 200, 'message' => 'success'])->setStatusCode();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function delete(Request $request)
    {
        Student::where('id', $request->get('id'))->delete();
        return response()->json(['code' => 200, 'message' => 'success']);
    }
}
