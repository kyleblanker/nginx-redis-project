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

Route::middleware(['redis.cache:3600,general'])->group(function(){
    Auth::routes();
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/about', 'HomeController@about')->name('about');
    Route::get('/services', 'HomeController@services')->name('services');
    Route::get('/contact', 'HomeController@contact')->name('contact');
});

Route::group(['middleware' => ['auth','redis.cache:300,session'], 'prefix' => 'account'], function () {
    Route::get('/','AccountController@index')->name('account.home');
});