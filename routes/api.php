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

Route::prefix('tasks')->group(function() {
    Route::get('activity', 'PublicController@actividad');
});

Route::get('message/{id}', 'MessageController@display');
Route::get('users/thismonth', 'UserController@mes');
Route::get('users/today', 'UserController@semana');

// modals y vuejs
Route::post('/referral/send', 'ReferralController@enviar');
Route::get('people', 'PublicController@home');
