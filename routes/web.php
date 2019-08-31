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

Route::get('/', 'MainPageController@index')->name('main');
//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/test1', function () {
    dump("test1");
});

Auth::routes();

Route::get('/home', 'MainPageController@index')->name('home');
