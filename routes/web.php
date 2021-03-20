<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::get('/', function(){

  return redirect()->route('dashboard.index');

});


Auth::routes(['register' => false]);

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function() {
        /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
        // Route::get('/', function () {
        //     return view('welcome');
        // });

        Route::get('/home', 'HomeController@index')->name('home');

        //Route::resource('users', 'UserController')->except(['show']);


});
