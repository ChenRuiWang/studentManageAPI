<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::namespace('Api')->group(function() {
    Route::post('/login', 'PublicController@login');
    Route::middleware('check')->group(function () {
        Route::post('/my', 'UserController@detail');
        Route::post('/logout', 'PublicController@logout');
    });
    Route::middleware('check.auth')->group(function() {
        Route::get('/student/{student}', 'StudentController@detail');
        Route::get('/students', 'StudentController@index');
        Route::post('/student', 'StudentController@add');
        Route::post('/student/{student}', 'StudentController@update');
        Route::delete('/student', 'StudentController@delete');
        Route::post('/user', 'userController@add');
    });
});