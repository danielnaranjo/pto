<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Menus
//Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/', 'HomeController@index');
Route::get('/home', 'PublicController@index');
Route::get('/ver/{categoria?}', 'PackageController@categorias');
Route::get('/explorar/{pais?}/{id?}', 'PackageController@pais');
Route::get('/envios', 'PackageController@index');
Route::get('/viajeros', 'TravelController@index');

// Recursos
Route::resource('balance', 'BalanceController');
Route::resource('comment', 'CommentController');
Route::resource('country', 'CountryController');
Route::resource('image', 'ImageController');
Route::resource('message', 'MessageController');
Route::resource('package', 'PackageController');
Route::resource('public', 'PublicController');
Route::resource('service', 'ServiceController');
Route::resource('user', 'UserController');
Route::resource('vote', 'VoteController');
Route::resource('withdraw', 'WithdrawController');

// Eliminar
Route::get('/balance/{id}/delete', ['as' => 'balance.destroy', 'uses' => 'BalanceController@destroy']);
Route::get('/comment/{id}/delete', ['as' => 'comment.destroy', 'uses' => 'CommentController@destroy']);
Route::get('/country/{id}/delete', ['as' => 'country.destroy', 'uses' => 'CountryController@destroy']);
Route::get('/image/{id}/delete', ['as' => 'image.destroy', 'uses' => 'ImageController@destroy']);
Route::get('/message/{id}/delete', ['as' => 'message.destroy', 'uses' => 'MessageController@destroy']);
Route::get('/package/{id}/delete', ['as' => 'package.destroy', 'uses' => 'PackageController@destroy']);
Route::get('/public/{id}/delete', ['as' => 'public.destroy', 'uses' => 'PublicController@destroy']);
Route::get('/service/{id}/delete', ['as' => 'service.destroy', 'uses' => 'ServiceController@destroy']);
Route::get('/user/{id}/delete', ['as' => 'user.destroy', 'uses' => 'UserController@destroy']);
Route::get('/vote/{id}/delete', ['as' => 'vote.destroy', 'uses' => 'VoteController@destroy']);
Route::get('/withdraw/{id}/delete', ['as' => 'withdraw.destroy', 'uses' => 'WithdrawController@destroy']);


Route::prefix('api')->group(function() {
    Route::get('message/{id}', 'MessageController@display');
});
