<?php

Route::group(["prefix" => "admin", "namespace" => "Admin", "middleware" => ['auth', 'admin-auth']], function(){
   Route::get("index", "AdminController@index"); // TODO remove

   Route::group(['prefix' => "products"], function(){
       Route::get("", "ProductController@index")->name("admin-products");
       Route::get("edit/{id}", "ProductController@edit")->name("admin-products-edit");
       Route::post("update/{id}", "ProductController@update")->name("admin-products-update");
       Route::any("delete/{id}", "ProductController@destroy")->name("admin-products-delete");
       Route::get("create", "ProductController@create")->name("admin-products-create");
       Route::post("store", "ProductController@store")->name("admin-products-store");
       Route::get("show/{id}", "ProductController@show")->name("admin-products-show");
       Route::any('save-products-as-xml', "ProductController@saveAsXml")->name('save-products-as-xml');
       Route::any('add-new-property', "ProductController@addNewProperty")->name('add-new-property');
       Route::any('add-new-image', "ProductController@addNewImage")->name('add-new-image');
       Route::post('filter', "ProductController@filter");
       Route::post('get_products', "ProductController@getProducts");
       Route::post('index_products', "ProductController@indexProducts");

       #Route::any("test", "ProductController@storageLearn");
       #Route::any("lang", "ProductController@lang");
       #Route::any("email", "ProductController@email");
   });

    Route::group(['prefix' => "clients"], function(){
        Route::get("", "ClientController@index")->name("admin-clients");
        Route::get("edit/{id}", "ClientController@edit")->name("admin-clients-edit");
        Route::post("update/{id}", "ClientController@update")->name("admin-clients-update");
        Route::any("delete/{id}", "ClientController@destroy")->name("admin-clients-delete");
        Route::get("create", "ClientController@create")->name("admin-clients-create");
        Route::post("store", "ClientController@store")->name("admin-clients-store");
        Route::get("show/{id}", "ClientController@show")->name("admin-clients-show");
        Route::post('filter', "ClientController@filter");
    });

    Route::group(['prefix' => "notifications"], function(){
        Route::get("", "NotificationController@index")->name("admin-notifications");
        Route::get("edit/{id}", "NotificationController@edit")->name("admin-notifications-edit");
        Route::post("update/{id}", "NotificationController@update")->name("admin-notifications-update");
        Route::any("delete/{id}", "NotificationController@destroy")->name("admin-notifications-delete");
        Route::get("create", "NotificationController@create")->name("admin-notifications-create");
        Route::post("store", "NotificationController@store")->name("admin-notifications-store");
        Route::get("show/{id}", "NotificationController@show")->name("admin-notifications-show");
        Route::post('filter', "NotificationController@filter");
        Route::get('check_new', "NotificationController@checkNew");
    });

    Route::group(['prefix' => "categories"], function() {
        Route::get("", "CategoryController@index")->name("admin-categories");
        Route::get("edit/{id}", "CategoryController@edit")->name("admin-categories-edit");
        Route::post("update/{id}", "CategoryController@update")->name("admin-categories-update");
        Route::any("delete/{id}", "CategoryController@destroy")->name("admin-categories-delete");
        Route::get("create", "CategoryController@create")->name("admin-categories-create");
        Route::post("store", "CategoryController@store")->name("admin-categories-store");
        Route::get("show/{id}", "CategoryController@show")->name("admin-categories-show");
        Route::post('filter', "CategoryController@filter");
    });

    Route::group(['prefix' => "groups"], function() {
        Route::get("", "ModelGroupController@index")->name("admin-groups");
        Route::get("edit/{id}", "ModelGroupController@edit")->name("admin-groups-edit");
        Route::post("update/{id}", "ModelGroupController@update")->name("admin-groups-update");
        Route::any("delete/{id}", "ModelGroupController@destroy")->name("admin-groups-delete");
        Route::get("create", "ModelGroupController@create")->name("admin-groups-create");
        Route::post("store", "ModelGroupController@store")->name("admin-groups-store");
        Route::get("show/{id}", "ModelGroupController@show")->name("admin-groups-show");
        Route::post('filter', "ModelGroupController@filter");

        Route::any("modifications", "ModelGroupController@getModificationsBlock")->name("admin-groups-get-modifications");
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

    Route::group(['prefix' => "sizes"], function() { //TODO
        Route::get("", "SizeController@index")->name("admin-sizes");
//        Route::get("edit/{id}", "ModelGroupController@edit")->name("admin-groups-edit");
//        Route::post("update/{id}", "ModelGroupController@update")->name("admin-groups-update");
//        Route::any("delete/{id}", "ModelGroupController@destroy")->name("admin-groups-delete");
//        Route::get("create", "ModelGroupController@create")->name("admin-groups-create");
//        Route::post("store", "ModelGroupController@store")->name("admin-groups-store");
//        Route::get("show/{id}", "ModelGroupController@show")->name("admin-groups-show");
    });

    Route::group(['prefix' => "colors"], function() { //TODO
        Route::get("", "ColorController@index")->name("admin-colors");
//        Route::get("edit/{id}", "ModelGroupController@edit")->name("admin-colors-edit");
//        Route::post("update/{id}", "ModelGroupController@update")->name("admin-colors-update");
//        Route::any("delete/{id}", "ModelGroupController@destroy")->name("admin-colors-delete");
//        Route::get("create", "ModelGroupController@create")->name("admin-colors-create");
//        Route::post("store", "ModelGroupController@store")->name("admin-colors-store");
//        Route::get("show/{id}", "ModelGroupController@show")->name("admin-colors-show");
    });

    Route::group(['prefix' => "orders"], function() {
        Route::get("", "OrderController@index")->name("admin-orders");
        Route::get("edit/{id}", "OrderController@edit")->name("admin-orders-edit");
        Route::post("update/{id}", "OrderController@update")->name("admin-orders-update");
        Route::any("delete/{id}", "OrderpController@destroy")->name("admin-orders-delete");
        Route::get("create", "OrderController@create")->name("admin-orders-create");
        Route::post("store", "OrderController@store")->name("admin-orders-store");
        Route::get("show/{id}", "OrderController@show")->name("admin-orders-show");
        Route::any("email", "OrderController@email")->name("admin-orders-email");
        Route::post("send-email", "OrderController@sendEmail")->name("admin-orders-send-email");
        Route::post('filter', "OrderController@filter");
        Route::post('get_client_data', "OrderController@getClientData");

        Route::any("telegram/{id}", "OrderController@pushToTelegram")->name("admin-orders-push-to-telegram");
        Route::any("add_product_to_basket", "OrderController@addBasketProduct")->name("admin-orders-add-product-to-basket");
        Route::any("remove_basket", "OrderController@removeBasket")->name("admin-orders-remove-basket");
        Route::any("selectCity", "OrderController@selectCity")->name("admin-orders-select-city");
        Route::any("selectDeliveryType", "OrderController@selectDeliveryType")->name("admin-orders-select-delivery-type");
    });

    Route::group(['prefix' => 'shares'], function(){
        Route::get('', "ShareController@index")->name("admin-shares");
        Route::get("edit/{id}", "ShareController@edit")->name("admin-shares-edit");
        Route::post("update/{id}", "ShareController@update")->name("admin-shares-update");
        Route::any("delete/{id}", "ShareController@destroy")->name("admin-shares-delete");
        Route::get("create", "ShareController@create")->name("admin-shares-create");
        Route::post("store", "ShareController@store")->name("admin-shares-store");
        Route::get("show/{id}", "ShareController@show")->name("admin-shares-show");
        Route::post('filter', "ShareController@filter");


        Route::any("addNewCondition", "ShareController@addNewCondition")->name("admin-shares-add-new-condition");
        Route::any("loadConditionValues", "ShareController@loadConditionValues")->name("admin-shares-add-new-condition-values");
//        Route::any("email", "OrderController@email")->name("admin-orders-email");
//        Route::post("send-email", "OrderController@sendEmail")->name("admin-orders-send-email");
    });

    Route::group(['prefix' => "stock"], function(){
        Route::get("", "StockController@index")->name("admin-stock");
        Route::post("change_quantity", "StockController@changeQuantity")->name("admin-stock-change-quantity");
//        Route::get("edit/{id}", "ProductController@edit")->name("admin-products-edit");
//        Route::post("update/{id}", "ProductController@update")->name("admin-products-update");
//        Route::any("delete/{id}", "ProductController@destroy")->name("admin-products-delete");
//        Route::get("create", "ProductController@create")->name("admin-products-create");
//        Route::post("store", "ProductController@store")->name("admin-products-store");
//        Route::get("show/{id}", "ProductController@show")->name("admin-products-show");
//        Route::any('save-products-as-xml', "ProductController@saveAsXml")->name('save-products-as-xml');
//        Route::any('add-new-property', "ProductController@addNewProperty")->name('add-new-property');
//        Route::any('add-new-image', "ProductController@addNewImage")->name('add-new-image');
    });

    Route::group(['prefix' => "stats"], function(){
        Route::get("", "StatisticController@index")->name("admin-stats");
        Route::get("top_products", "StatisticController@getTopProducts")->name("admin-stats-top-products");
        Route::post("orders_stats", "StatisticController@getOrdersStats")->name("admin-stats-orders");
        Route::post("orders_payment_types_stats", "StatisticController@getOrdersPaymentTypesStats")->name("admin-stats-orders-payment-types");
//        Route::get("edit/{id}", "ProductController@edit")->name("admin-products-edit");
//        Route::post("update/{id}", "ProductController@update")->name("admin-products-update");
//        Route::any("delete/{id}", "ProductController@destroy")->name("admin-products-delete");
//        Route::get("create", "ProductController@create")->name("admin-products-create");
//        Route::post("store", "ProductController@store")->name("admin-products-store");
//        Route::get("show/{id}", "ProductController@show")->name("admin-products-show");
//        Route::any('save-products-as-xml', "ProductController@saveAsXml")->name('save-products-as-xml');
//        Route::any('add-new-property', "ProductController@addNewProperty")->name('add-new-property');
//        Route::any('add-new-image', "ProductController@addNewImage")->name('add-new-image');
    });

    Route::group(['prefix' => "ceo"], function() {
        Route::get("", "CeoController@index")->name("admin-ceo");
//        Route::get("edit/{id}", "CeoController@edit")->name("admin-ceo-edit");
//        Route::post("update/{id}", "CeoController@update")->name("admin-ceo-update");
//        Route::any("delete/{id}", "CeoController@destroy")->name("admin-ceo-delete");
//        Route::get("create", "CeoController@create")->name("admin-ceo-create");
//        Route::post("store", "CeoController@store")->name("admin-ceo-store");
//        Route::get("show/{id}", "CeoController@show")->name("admin-ceo-show");
//        Route::post('filter', "CeoController@filter");

        Route::any("modifications", "ModelGroupController@getModificationsBlock")->name("admin-groups-get-modifications");
    });

    Route::group(['prefix' => "email"], function() {
        Route::any("new", "EmailController@newEmail")->name("admin-new-email");
        Route::post("send-email", "EmailController@sendEmail")->name("admin-send-email");
    });

    Route::group(['prefix' => 'ajax'], function(){
        Route::post('translate', "AjaxController@getTranslation");
//        Route::post('filer_table', "AjaxController@getFilteredData");
    });

});



///
Route::group(['prefix' => "learn"], function(){
    Route::any("test", "LearnController@storageLearn");
    Route::any("lang", "LearnController@lang");
    Route::any("email", "LearnController@email");
    Route::any("pagination", "LearnController@pagination");
    Route::any("redis", "LearnController@redis");
    Route::any("session", "LearnController@session");
    Route::any("blade", "LearnController@blade");

    Route::any("insta", "LearnController@insta");


    Route::any("api1", "LearnController@api1");
    Route::any("api2", "LearnController@api2");
    Route::any("api3", "LearnController@api3");
    Route::any("f1", "LearnController@testF1");
    Route::any("f2", "LearnController@testF2");

    Route::any("sql1", "LearnController@selectSql");

    Route::any("l1", "LearnController@l1");
    Route::any("l2", "LearnController@l2");
    Route::any("l3", "LearnController@l3");
    Route::any("l4", "LearnController@l4");
    Route::any("l5", "LearnController@l5");
    Route::any("l6", "LearnController@l6");
    Route::any("l7", "LearnController@l7");
    Route::any("l8", "LearnController@l8");
});