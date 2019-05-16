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
    //return 7;
    return $request->all();
    return $request->user();
});

Route::group(['middleware' => ['api-auth']], function(){
    Route::get("orders", "Api\OrderController@getOrders");
    Route::get("orders/{order}", "Api\OrderController@getOrder");

    Route::get("users", "Api\UserController@getUsers");
    Route::get("users/{user}", "Api\UserController@getUser");
//   Route::any("clients/{user}", function($user){
//       return new \App\Http\Resources\UserResource($user);
//   });
});
