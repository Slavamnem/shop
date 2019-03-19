<?php

Route::group(["prefix" => "admin", "namespace" => "Admin", "middleware" => ['auth']], function(){
   Route::get("index", "AdminController@index"); // TODO remove

   Route::group(['prefix' => "products"], function(){
       Route::get("", "ProductController@index")->name("admin-products");
       Route::get("edit/{id}", "ProductController@edit")->name("admin-products-edit");
       Route::post("update/{id}", "ProductController@update")->name("admin-products-update");
       Route::any("delete/{id}", "ProductController@destroy")->name("admin-products-delete");
   });
});