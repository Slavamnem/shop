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

Route::group(['namespace' => 'Site'], function(){
    Route::get('/', 'MainPageController@index')->name('main');
    Route::get('/poster', 'PosterController@index')->name('poster');
    Route::get('/tracks', 'TrackController@index')->name('tracks');
    Route::get('/clips', 'ClipController@index')->name('clips');
    Route::get('/contacts', 'SocialMediaController@index')->name('contacts');
    Route::get('/product/{slug}', 'ProductCardController@index')->name('product-card');

    Route::group(['prefix' => 'order'], function(){
        Route::get('add_basket_product', 'OrderController@addBasketProduct')->name('order-add-basket-product');
        Route::get('change_quantity', 'OrderController@changeQuantity')->name('order-change-quantity-product');
        Route::get('remove_basket_product', 'OrderController@removeProduct')->name('order-remove-product');
        Route::get('checkout', 'OrderController@checkout')->name('order-checkout');
        Route::post('create_order', 'OrderController@createOrder')->name('checkout-create-order');
        Route::post('get_client_data', "OrderController@getClientData");
        Route::any("selectCity", "OrderController@selectCity")->name("orders-select-city");
        Route::any("selectDeliveryType", "OrderController@selectDeliveryType")->name("orders-select-delivery-type");
    });

    Route::group(['namespace' => 'Api', 'prefix' => 'api'], function(){
        Route::get('get_filtered_products', 'CatalogProductsController@getFilteredProducts')->name('api-get-filtered-products');
        Route::get('get_catalog_data', 'CatalogProductsController@getCatalogData')->name('api-get-catalog-data');
    });
});

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/test1', function () {
    dump("test1");
});

Auth::routes();

Route::get('/home', 'MainPageController@index')->name('home');
