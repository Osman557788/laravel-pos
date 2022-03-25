<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web']],function(){

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
    Route::resource('clients.orders', 'Client\OrderController')->except(['show']);
    Route::get('products', 'Client\OrderController@getProductsWithCategories');
    // order
    Route::resource('orders', 'OrderController');
    Route::get('order/{order}', 'OrderController@getProductOfOrder');
    // Route::resource('orders', 'OrderController')->except(['create','update','store','edit']);
   

});
