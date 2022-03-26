<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>['auth']],function(){
    //welcom
    Route::get('/', 'WelcomeController@index')->name('welcome');
    
    // users
    Route::resource('user', 'UserController'); 

    // catgorie
    Route::resource('catgorie', 'CatgorieController'); 

    // client
    Route::resource('client', 'ClientController');

    // product
    Route::resource('product', 'ProductController'); 

    //client order 
    Route::resource('clients.orders', 'Client\OrderController');
    Route::get('products', 'Client\OrderController@getProductsWithCategories');
    // order
    Route::resource('orders', 'OrderController');
    Route::get('order/{order}', 'OrderController@getProductOfOrder');

});
