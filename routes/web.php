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

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;

Route::get('/', function () {
//    Redis::set('name', 'Dimon');
//    Cache::put('foo', 'bar', 10);
//    return Cache::get('foo');
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/get-json', 'HomeController@getJson')->name('getjson');

Route::get('/random-chart', 'HomeController@chartRandom');

Route::get('/data-chart', 'HomeController@chartData');

Route::get('/socket-chart', 'HomeController@newEvent');

Route::get('/chat', 'HomeController@showChart');

Route::get('/chat/sendMessage', 'HomeController@sendMessage');

Route::get('/chat/private', 'HomeController@showPrivateChat');

Route::get('/chat/private/sendMessage', 'HomeController@sendPrivateMessage');

Route::get('/echo-chat', 'HomeController@showEchoChat');

Route::post('/echo-chat/send', 'HomeController@sendEchoMessage');

Route::get('/room/{room}', 'HomeController@privateRoom');

Route::post('/private-echo-chat/send', 'HomeController@sendPrivateEchoMessage');


Route::get('/redis', function(){
    $data = [
        'event' => 'UserSignedUp',
        'data'  => [
            'username' => 'Dima',
            'email'    => 'dima.maimesko@gmail.com'
        ]
    ];
    Redis::publish('test-channel', json_encode($data));//Posts a message to the given channel
    return view('client-view');
});


Route::get('/event', function(){
    event(new \App\Events\NewEvent('Dima Maimesko (info from event)'));
    return view('client-view');
});
