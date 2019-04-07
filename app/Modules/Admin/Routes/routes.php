<?php

Route::group(['namespace' => 'App\Modules\Admin\Controllers', 'prefix' => 'milan_admin'], function(){
    Route::get('/', 'ProductController@index');
});