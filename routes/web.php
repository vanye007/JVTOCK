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


Route::get('/buyer', 'buyerController@index');
Route::get('/supplier', 'buyerController@supplier');
Route::post('/buyer_request','buyerController@buyer_request');
Route::get('/product-page/{id}/{encrypted_session}/{name}','buyerController@product_specs');
Route::get('/inquiry/{id}/{session}','buyerController@inquiry');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
