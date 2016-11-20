<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::put('/home{id}',['as'=>'home.update','uses'=>'HomeController@update']);
Route::post('/home',['as'=>'history.store','uses'=>'HistoryController@store']);
Route::delete('/home{user_id}',['as'=>'history.destroy','uses'=>'HistoryController@destroy']);
Route::delete('/home/delete{id}',['as'=>'history.delete','uses'=>'HistoryController@delete']);