<?php

use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Route;



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function() {

    Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function (){


        Route::get('/index','DashboardController@index')->name('index');


        // users routes
        Route::resource('users','UserController')->except(['show']);

        // categories routes
        Route::resource('categories','CategoryController')->except(['show']);

        // products routes
        Route::resource('products','ProductController')->except(['show']);

        // clients routes
        Route::resource('clients', 'ClientController')->except(['show']);
        Route::resource('clients.orders', 'Client\OrderController')->except(['show']);


        //order routes
        Route::resource('/orders', 'OrderController');
        Route::get('/orders/{order}/products','OrderController@products')->name('orders.products');




    });


});
