<?php

Route::group(["prefix" => "admin", "namespace" => "Admin", "middleware" => ['auth']], function(){
   Route::get("index", "AdminController@index"); // TODO remove

   Route::group(['prefix' => "products"], function(){
       Route::get("", "ProductController@index")->name("admin-products");
   });
});