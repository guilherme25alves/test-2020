<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/*
Route::get('/students', '');
Route::get('/students/{student_id}', '');
Route::get('/students/{field}/{value}', '');
Route::post('/students', '');
Route::put('/students', '');
Route::delete('/students', '');

Route::get('/courses', '');
Route::get('/courses/{course_id}', '');
Route::get('/courses/{field}/{value}', '');
Route::post('/courses', '');
Route::put('/courses', '');
Route::delete('/courses', '');

Route::get('/enrollments', '');
Route::get('/enrollments/{enrollment_id}', '');
Route::get('/enrollments/{field}/{value}', '');
Route::post('/enrollments', '');
Route::put('/enrollments', '');
Route::delete('/enrollments', '');
*/
