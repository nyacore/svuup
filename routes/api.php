<?php

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

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'Auth\AuthController@login');
    Route::post('registration', 'Auth\AuthController@registration');
    Route::post('logout', 'Auth\AuthController@logout');
    Route::post('refresh', 'Auth\AuthController@refresh');
    Route::post('me', 'Auth\AuthController@me');
});

Route::resource('users', UserController::class);
Route::resource('faculties', FacultyController::class);
Route::post('specialities/{id}/disciplines', SpecialityController::class . '@disciplines');
Route::resource('specialities', SpecialityController::class);
Route::resource('roles', RoleController::class);
Route::resource('disciplines', DisciplineController::class);
Route::post('groups/{id}/user', GroupController::class . '@user');
Route::resource('groups', GroupController::class);
Route::resource('events', EventController::class);
Route::resource('marks', MarkController::class);
Route::resource('threads', ThreadController::class);
Route::resource('messages', MessageController::class);
