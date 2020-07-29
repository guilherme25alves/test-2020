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
    Route::get('/students/{id}', 'StudentsController@getById');
    Route::get('/students/search-text/{text}', 'StudentsController@getByTextField');
    Route::get('/students/name/{name}', 'StudentsController@getByName');
    Route::get('/students/enrollments/{id}', 'StudentsController@getEnrollmentsByStudent');
    Route::get('/students/email/{email}', 'StudentsController@getByEmail');
    Route::post('/students', 'StudentsController@store');
    Route::put('/students/{id}', 'StudentsController@update');
    Route::delete('/students/{id}', 'StudentsController@delete');

    Route::get('/courses', 'CoursesController@get');
    Route::get('/courses/{id}', 'CoursesController@getById');
    Route::get("/courses/enrollments/{id}", 'CoursesController@getEnrollmentsByCourse');
    Route::get('/courses/title/{title}', 'CoursesController@getByTitle');
    Route::post('/courses', 'CoursesController@store');
    Route::put('/courses/{id}', 'CoursesController@update');
    Route::delete('/courses/{id}', 'CoursesController@delete');

    Route::get('/enrollments', 'EnrollmentsController@get');
    Route::get('/enrollments/{id}', 'EnrollmentsController@getById');
    Route::post('/enrollments', 'EnrollmentsController@store');
    Route::put('/enrollments/{id}', 'EnrollmentsController@update');
    Route::delete('/enrollments/{id}', 'EnrollmentsController@delete');

});
