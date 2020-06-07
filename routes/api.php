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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('students', 'StudentController@create');
Route::delete('students/{id}', 'StudentController@delete');

Route::post('teachers', 'TeacherController@create');
Route::delete('teachers/{id}', 'TeacherController@delete');

Route::post('classes', 'ClassController@create');
Route::patch('classes/{id}', 'ClassController@modifyClassTeacher');
Route::delete('classes/{id}', 'ClassController@delete');
Route::get('classes/{id}', 'ClassController@getClassInfo');

Route::get('electives/{id}', 'ClassController@getClassMember');
Route::post('electives', 'ClassController@createElectives');
Route::delete('electives/{id}', 'ClassController@deleteElectives');


