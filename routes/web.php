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
//Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/', 'HomeController@index');
Route::get('/home', 'userController@index');


Route::resource('balance', 'BalanceController');
Route::resource('comment', 'commentController');
Route::resource('image', 'imageController');
Route::resource('message', 'messageController');
Route::resource('package', 'packageController');
Route::resource('service', 'serviceController');
Route::resource('user', 'userController');
Route::resource('vote', 'voteController');
Route::resource('withdraw', 'withdrawController');
