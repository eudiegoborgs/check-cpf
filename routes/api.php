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


Route::get('check-cpf', 'BlackListController@checkCpf')->name('check-cpf');
Route::post('black-list', 'BlackListController@store');
Route::get('black-list', 'BlackListController@index');
Route::delete('black-list/{cpf?}', 'BlackListController@destroy');
Route::get('status', 'HomeController@getStatus');