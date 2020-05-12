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

Route::group(['prefix' => 'admin', 'middleware' => 'auth:api'], static function () {
    Route::get('leads/{lead}/tasks', 'PersonalArea\LeadController@tasks');
    Route::resource('leads', 'PersonalArea\LeadController');
    Route::resource('tasks', 'PersonalArea\TaskController');
    // Route::get('contacts', 'contactsController');
    // Route::get('reports', 'reportsController');
    // Route::get('calls','callsController');
    // Route::get('help','helpController');
    // Route::get('personal','personalController');
    // Route::get('team','teamController');
    // Route::get('balance','balanceController');
    // Route::get('partner','partnerController');
});
