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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('registration', 'AuthController@registration');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::get('/','HomeController@index');
// Route::get('/','Controller');
Route::group([ 'prefix' => 'admin'], static function () {
        Route::resource('leads', 'LeadsController');
        // Route::get('contacts', 'contactsController');
        // Route::get('reports', 'reportsController');
        // Route::get('calls','callsController');
        // Route::get('help','helpController');
        // Route::get('personal','personalController');
        // Route::get('team','teamController');
        // Route::get('balance','balanceController');
        // Route::get('partner','partnerController');
});


