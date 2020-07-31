<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Students;
use App\Http\Resources\StudentsResource;

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

Route::group([ 'prefix' => env('API_VERSION')], function () {
   
    Route::get('/students', 'StudentsController@get');
    Route::get('/students/{student_id}', 'StudentsController@getById');
    Route::get('/students/search-text/{text}', 'StudentsController@getByTextField');
    Route::get('/students/name/{name}', 'StudentsController@getByName');
    Route::get('/students/enrollments/{student_id}', 'StudentsController@getEnrollmentsByStudent');
    Route::get('/students/email/{email}', 'StudentsController@getByEmail');
    Route::post('/students', 'StudentsController@store');
    Route::put('/students/{student_id}', 'StudentsController@update');
    Route::delete('/students/{student_id}', 'StudentsController@delete');

    Route::get('/courses', 'CoursesController@get');
    Route::get('/courses/{course_id}', 'CoursesController@getById');
    Route::get("/courses/enrollments/{course_id}", 'CoursesController@getEnrollmentsByCourse');
    Route::get('/courses/title/{title}', 'CoursesController@getByTitle');
    Route::post('/courses', 'CoursesController@store');
    Route::put('/courses/{course_id}', 'CoursesController@update');
    Route::delete('/courses/{course_id}', 'CoursesController@delete');

    Route::get('/enrollments', 'EnrollmentsController@get');
    Route::get('/enrollments/{enrollment_id}', 'EnrollmentsController@getById');
    Route::post('/enrollments', 'EnrollmentsController@store');
    Route::put('/enrollments/{enrollment_id}', 'EnrollmentsController@update');
    Route::delete('/enrollments/{enrollment_id}', 'EnrollmentsController@delete');

});
