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

Route::get('/', 'buyerController@Welcome');
Route::get('/buyer', 'buyerController@index');
Route::get('/supplier', 'supplierController@supplier');
Route::post('/buyer_request','buyerController@buyer_request');
Route::post('/submit_supply','supplierController@submit_supply');
Route::get('/product-page/{id}/{encrypted_session}/{name}','buyerController@product_specs');
Route::get('/inquiry/{id}/{session}','buyerController@inquiry');
Route::get('/mail','buyerController@mail');




Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/buyer-database','HomeController@buyer_database');
Route::get('/edit-template','HomeController@edit_template');
Route::get('/supplier-database','HomeController@supplier_database');
Route::get('/inventory','HomeController@inventory');
Route::get('/action-items','HomeController@action_items');
Route::post('/send_message','messageController@send_message');
Route::get('/supplier_info/{id}','HomeController@supplier_info');
Route::get('/buyer_info/{id}','HomeController@buyer_info');
Route::get('/product-info/{id}','HomeController@retrieve_product');
Route::post('/update_product/{id}','HomeController@update_product');


Route::get('/logout', function ()
{
    auth()->logout();
    Session()->flush();

    return Redirect::to('/login');
})->name('logout');
