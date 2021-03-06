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


Route::group(['prefix' => 'v1'], function() {
    Route::get('/', function() {
        return 'Techinnover Data collection test API version 1.0.0';
    });

    Route::post('/create-account', 'RegistrationController@store');
    Route::get('/account/{id}', 'RegistrationController@show');
    Route::put('/account/update/{id}', 'RegistrationController@update');
    Route::delete('/account/{id}', 'RegistrationController@delete');
});