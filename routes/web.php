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


Route::get('/buyer', 'publicController@index');
Route::get('/supplier', 'publicController@supplier');
Route::post('/buyer_request','publicController@buyer_request');
Route::get('/product-page/{id}/{encrypted_session}/{name}','publicController@product_specs');
Route::get('/inquiry/{id}/{session}','publicController@inquiry');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
