<?php

Route::group(["prefix" => "admin", "namespace" => "Admin", "middleware" => ['auth']], function(){
   Route::get("index", "AdminController@index"); // TODO remove

   Route::group(['prefix' => "products"], function(){
       Route::get("", "ProductController@index")->name("admin-products");
       Route::get("edit/{id}", "ProductController@edit")->name("admin-products-edit");
       Route::post("update/{id}", "ProductController@update")->name("admin-products-update");
       Route::any("delete/{id}", "ProductController@destroy")->name("admin-products-delete");
       Route::get("create", "ProductController@create")->name("admin-products-create");
       Route::post("store", "ProductController@store")->name("admin-products-store");
       Route::get("show/{id}", "ProductController@show")->name("admin-products-show");

       Route::any("test", "ProductController@storageLearn");
   });

    Route::group(['prefix' => "categories"], function() {
        Route::get("", "CategoryController@index")->name("admin-categories");
        Route::get("edit/{id}", "CategoryController@edit")->name("admin-categories-edit");
        Route::post("update/{id}", "CategoryController@update")->name("admin-categories-update");
        Route::any("delete/{id}", "CategoryController@destroy")->name("admin-categories-delete");
        Route::get("create", "CategoryController@create")->name("admin-categories-create");
        Route::post("store", "CategoryController@store")->name("admin-categories-store");
        Route::get("show/{id}", "CategoryController@show")->name("admin-categories-show");
    });

    Route::group(['prefix' => "groups"], function() {
        Route::get("", "ModelGroupController@index")->name("admin-groups");
        Route::get("edit/{id}", "ModelGroupController@edit")->name("admin-groups-edit");
        Route::post("update/{id}", "ModelGroupController@update")->name("admin-groups-update");
        Route::any("delete/{id}", "ModelGroupController@destroy")->name("admin-groups-delete");
        Route::get("create", "ModelGroupController@create")->name("admin-groups-create");
        Route::post("store", "ModelGroupController@store")->name("admin-groups-store");
        Route::get("show/{id}", "ModelGroupController@show")->name("admin-groups-show");
    });

    //
    Route::group(['prefix' => "product-statuses"], function() {
        Route::get("", "ProductStatusController@index")->name("admin-product-statuses");
        Route::get("edit/{id}", "ProductStatusController@edit")->name("admin-product-statuses-edit");
        Route::post("update/{id}", "ProductStatusController@update")->name("admin-product-statuses-update");
        Route::any("delete/{id}", "ProductStatusController@destroy")->name("admin-product-statuses-delete");
        Route::get("create", "ProductStatusController@create")->name("admin-product-statuses-create");
        Route::post("store", "ProductStatusController@store")->name("admin-product-statuses-store");
        Route::get("show/{id}", "ProductStatusController@show")->name("admin-product-statuses-show");
    });

    Route::group(['prefix' => "sizes"], function() {
        Route::get("", "SizeController@index")->name("admin-sizes");
        Route::get("edit/{id}", "ModelGroupController@edit")->name("admin-groups-edit");
        Route::post("update/{id}", "ModelGroupController@update")->name("admin-groups-update");
        Route::any("delete/{id}", "ModelGroupController@destroy")->name("admin-groups-delete");
        Route::get("create", "ModelGroupController@create")->name("admin-groups-create");
        Route::post("store", "ModelGroupController@store")->name("admin-groups-store");
        Route::get("show/{id}", "ModelGroupController@show")->name("admin-groups-show");
    });

    Route::group(['prefix' => "colors"], function() {
        Route::get("", "ColorController@index")->name("admin-colors");
        Route::get("edit/{id}", "ModelGroupController@edit")->name("admin-groups-edit");
        Route::post("update/{id}", "ModelGroupController@update")->name("admin-groups-update");
        Route::any("delete/{id}", "ModelGroupController@destroy")->name("admin-groups-delete");
        Route::get("create", "ModelGroupController@create")->name("admin-groups-create");
        Route::post("store", "ModelGroupController@store")->name("admin-groups-store");
        Route::get("show/{id}", "ModelGroupController@show")->name("admin-groups-show");
    });

    Route::group(['prefix' => "orders"], function() {
        Route::get("", "OrderController@index")->name("admin-orders");
    });
});