<?php

Route::group(["prefix" => "admin", "namespace" => "Admin", "middleware" => ['auth', 'admin-auth']], function(){
   Route::get("index", "AdminController@index"); // TODO remove

    Route::group(['prefix' => "commands"], function(){
        Route::get("", "CommandController@index")->name("admin-commands");
        Route::post("search", "CommandController@search")->name("admin-commands-search");
        Route::post("execute", "CommandController@execute")->name("admin-commands-execute");
//        Route::get("edit/{id}", "ProductController@edit")->name("admin-products-edit");
//        Route::post("update/{id}", "ProductController@update")->name("admin-products-update");
//        Route::any("delete/{id}", "ProductController@destroy")->name("admin-products-delete");
//        Route::get("create", "ProductController@create")->name("admin-products-create");
//        Route::post("store", "ProductController@store")->name("admin-products-store");
//        Route::get("show/{id}", "ProductController@show")->name("admin-products-show");
//        Route::any('save-products-as-xml', "ProductController@saveAsXml")->name('save-products-as-xml');
//        Route::any('save-products-as-txt', "ProductController@saveAsTxt")->name('save-products-as-txt');
//        Route::any('add-new-property', "ProductController@addNewProperty")->name('add-new-property');
//        Route::any('add-new-image', "ProductController@addNewImage")->name('add-new-image');
//        Route::post('filter', "ProductController@filter");
//        Route::post('get_products', "ProductController@getProducts");
//        Route::post('index_products', "ProductController@indexProducts");

        #Route::any("test", "ProductController@storageLearn");
        #Route::any("lang", "ProductController@lang");
        #Route::any("email", "ProductController@email");
    });

   Route::group(['prefix' => "products"], function(){
       Route::get("", "ProductController@index")->name("admin-products");
       Route::get("edit/{id}", "ProductController@edit")->name("admin-products-edit");
       Route::post("update/{id}", "ProductController@update")->name("admin-products-update");
       Route::any("delete/{id}", "ProductController@destroy")->name("admin-products-delete");
       Route::get("create", "ProductController@create")->name("admin-products-create");
       Route::post("store", "ProductController@store")->name("admin-products-store");
       Route::get("show/{id}", "ProductController@show")->name("admin-products-show");
       Route::any('save-products-as-xml', "ProductController@saveAsXml")->name('save-products-as-xml');
       Route::any('save-products-as-txt', "ProductController@saveAsTxt")->name('save-products-as-txt');
       Route::any('add-new-property', "ProductController@addNewProperty")->name('add-new-property');
       Route::any('get-property-values', "ProductController@getPropertyValues")->name('get-property-values');
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

    Route::group(['prefix' => "sizes"], function() {
        Route::get("", "SizeController@index")->name("admin-sizes");
        Route::get("edit/{id}", "SizeController@edit")->name("admin-sizes-edit");
        Route::post("update/{id}", "SizeController@update")->name("admin-sizes-update");
        Route::any("delete/{id}", "SizeController@destroy")->name("admin-sizes-delete");
        Route::get("create", "SizeController@create")->name("admin-sizes-create");
        Route::post("store", "SizeController@store")->name("admin-sizes-store");
        Route::get("show/{id}", "SizeController@show")->name("admin-sizes-show");
    });

    Route::group(['prefix' => "colors"], function() {
        Route::get("", "ColorController@index")->name("admin-colors");
        Route::get("edit/{id}", "ColorController@edit")->name("admin-colors-edit");
        Route::post("update/{id}", "ColorController@update")->name("admin-colors-update");
        Route::any("delete/{id}", "ColorController@destroy")->name("admin-colors-delete");
        Route::get("create", "ColorController@create")->name("admin-colors-create");
        Route::post("store", "ColorController@store")->name("admin-colors-store");
        Route::get("show/{id}", "ColorController@show")->name("admin-colors-show");
    });

    Route::group(['prefix' => "users"], function() {
        Route::get("", "UserController@index")->name("admin-users");
        Route::get("edit/{id}", "UserController@edit")->name("admin-users-edit");
        Route::post("update/{id}", "UserController@update")->name("admin-users-update");
        Route::any("delete/{id}", "UserController@destroy")->name("admin-users-delete");
        Route::get("create", "UserController@create")->name("admin-users-create");
        Route::post("store", "UserController@store")->name("admin-users-store");
        Route::get("show/{id}", "UserController@show")->name("admin-users-show");
    });

    Route::group(['prefix' => "roles"], function() {
        Route::get("", "RoleController@index")->name("admin-roles");
        Route::get("edit/{id}", "RoleController@edit")->name("admin-roles-edit");
        Route::post("update/{id}", "RoleController@update")->name("admin-roles-update");
        Route::any("delete/{id}", "RoleController@destroy")->name("admin-roles-delete");
        Route::get("create", "RoleController@create")->name("admin-roles-create");
        Route::post("store", "RoleController@store")->name("admin-roles-store");
        Route::get("show/{id}", "RoleController@show")->name("admin-roles-show");
    });

    Route::group(['prefix' => "auth"], function() {
        Route::get("", "AdminAuthController@index")->name("admin-auth");
        Route::get("edit/{id}", "AdminAuthController@edit")->name("admin-auth-edit");
        Route::post("update/{id}", "AdminAuthController@update")->name("admin-auth-update");
        Route::any("delete/{id}", "AdminAuthController@destroy")->name("admin-auth-delete");
        Route::get("create", "AdminAuthController@create")->name("admin-auth-create");
        Route::post("store", "AdminAuthController@store")->name("admin-auth-store");
        Route::get("show/{id}", "AdminAuthController@show")->name("admin-auth-show");
    });

    Route::group(['prefix' => "delivery-type"], function() {
        Route::get("", "DeliveryTypeController@index")->name("admin-delivery-type");
        Route::get("edit/{id}", "DeliveryTypeController@edit")->name("admin-delivery-type-edit");
        Route::post("update/{id}", "DeliveryTypeController@update")->name("admin-delivery-type-update");
        Route::any("delete/{id}", "DeliveryTypeController@destroy")->name("admin-delivery-type-delete");
        Route::get("create", "DeliveryTypeController@create")->name("admin-delivery-type-create");
        Route::post("store", "DeliveryTypeController@store")->name("admin-delivery-type-store");
        Route::get("show/{id}", "DeliveryTypeController@show")->name("admin-delivery-type-show");
    });

    Route::group(['prefix' => "payment-type"], function() {
        Route::get("", "PaymentTypeController@index")->name("admin-payment-type");
        Route::get("edit/{id}", "PaymentTypeController@edit")->name("admin-payment-type-edit");
        Route::post("update/{id}", "PaymentTypeController@update")->name("admin-payment-type-update");
        Route::any("delete/{id}", "PaymentTypeController@destroy")->name("admin-payment-type-delete");
        Route::get("create", "PaymentTypeController@create")->name("admin-payment-type-create");
        Route::post("store", "PaymentTypeController@store")->name("admin-payment-type-store");
        Route::get("show/{id}", "PaymentTypeController@show")->name("admin-payment-type-show");
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
        Route::get("products_list", "StatisticController@getProductsList")->name("admin-stats-products-list-products");
        Route::get("top_clients", "StatisticController@getTopClients")->name("admin-stats-top-clients");

        Route::get("exportAllOrders", "StatisticController@exportAllOrders")->name("admin-orders-all-export");
        Route::get("exportYearOrders", "StatisticController@exportYearOrders")->name("admin-orders-year-export");
        Route::get("exportMonthOrders", "StatisticController@exportMonthOrders")->name("admin-orders-month-export");
        Route::get("exportDayOrders", "StatisticController@exportDayOrders")->name("admin-orders-day-export");

        Route::post("orders_stats", "StatisticController@getOrdersStats")->name("admin-stats-orders");
        Route::post("orders_stats_month", "StatisticController@getOrdersStatsMonth")->name("admin-stats-orders-month");
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

    Route::group(['prefix' => "site-elements"], function() {
        Route::get("", "SiteElementController@index")->name("admin-site-elements");
        Route::get("edit/{id}", "SiteElementController@edit")->name("admin-site-elements-edit");
        Route::post("update/{id}", "SiteElementController@update")->name("admin-site-elements-update");
        Route::any("delete/{id}", "SiteElementController@destroy")->name("admin-site-elements-delete");
        Route::get("create", "SiteElementController@create")->name("admin-site-elements-create");
        Route::post("store", "SiteElementController@store")->name("admin-site-elements-store");
        Route::get("show/{id}", "SiteElementController@show")->name("admin-site-elements-show");
        Route::post("getValueBlock", "SiteElementController@getValueBlock")->name("admin-site-elements-get-value-block");
        Route::post('filter', "SiteElementController@filter");
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

    Route::group(['prefix' => "reports"], function() {
        Route::get("", "ReportController@index")->name("admin-reports");
        Route::any("export", "ReportController@export")->name("admin-export");
    });

    Route::group(['prefix' => "email"], function() {
        Route::any("new", "EmailController@newEmail")->name("admin-new-email");
        Route::post("send-email", "EmailController@sendEmail")->name("admin-send-email");
    });

    Route::group(['prefix' => 'ajax'], function(){
        Route::post('translate', "AjaxController@getTranslation");
//        Route::post('filer_table', "AjaxController@getFilteredData");
    });

    Route::get("new-york-times", "NewYorkTimesController@index")->name("admin-new-york-times");
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
    Route::any("drive", "LearnController@drive");
    Route::any("drop", "LearnController@drop");


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