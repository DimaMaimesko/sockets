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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/get-json', 'HomeController@getJson')->name('getjson');

Route::get('/random-chart', 'HomeController@chartRandom');

Route::get('/data-chart', 'HomeController@chartData');
Route::get('/socket-chart', 'HomeController@newEvent');
