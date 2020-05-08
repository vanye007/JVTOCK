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


Route::post('/buyer_request','buyerController@buyer_request');
Route::post('/submit_supply','supplierController@submit_supply');
Route::post('/submit_referral_supply/{id}','supplierController@submit_referral_supply');
Route::post('/supplier_info','supplierController@supplier_info');
Route::post('/business_info','supplierController@submit_business_info');
Route::post('/submit_product_info','supplierController@submit_product_info');
Route::post('/packages','supplierController@store_package_info');

Route::get('/', 'buyerController@Welcome');
Route::get('/buyer', 'buyerController@index');
Route::get('/supplier', 'supplierController@supplier');
Route::get('/product-page/{id}/{encrypted_session}/{name}','buyerController@product_specs');
Route::get('/inquiry/{id}/{session}','buyerController@inquiry');
Route::get('/mail','buyerController@mail');
Route::get('/supplier_form/{id}','supplierController@supplier');
Route::get('/supplier_business_info/{id}','supplierController@get_business_info_page');
Route::get('/add_more_product','supplierController@add_more_product');



//
// Route::get('/test',function(){
//   return view('external_broker.confirmation');
// });



Auth::routes();

Route::get('/welcome','HomeController@welcome')->name('welcome');
Route::get('/home', 'HomeController@index')->name('home')->middleware('isUserApprove');
Route::get('/buyer-database','HomeController@buyer_database');
Route::get('/edit-template','HomeController@edit_template')->middleware('isUserApprove');
Route::get('/supplier-database','HomeController@supplier_database')->middleware('isUserApprove');
Route::get('/inventory','HomeController@inventory')->middleware('isUserApprove');
Route::get('/action-items','HomeController@action_items')->middleware('isUserApprove');
Route::get('/get_message/{type}/{email}','HomeController@get_message_template');
Route::get('/get_message/{type}','HomeController@get_message_template');
Route::get('/supplier_info/{id}','HomeController@supplier_info')->middleware('isUserApprove');
Route::get('/buyer_info/{id}','HomeController@buyer_info')->middleware('isUserApprove');
Route::get('/product-info/{id}','HomeController@retrieve_product')->middleware('isUserApprove');
Route::post('/update_product/{id}','HomeController@update_product')->middleware('isUserApprove');
Route::post('/upload_product','HomeController@upload_product')->middleware('isUserApprove');
Route::get('approve_product/{id}','HomeController@approve_product');
Route::get('delete_product/{id}','HomeController@delete_product');


Route::get('/certificates/{value}/{id}','fileController@view_certificates')->middleware('isUserApprove');
Route::get('/proof_of_life/{value}/{id}','fileController@view_proof_of_life')->middleware('isUserApprove');
Route::get('/view_proof_of_funds/{name}/{id}','fileController@view_proof_of_funds')->middleware('isUserApprove');


Route::post('/send_message','messageController@send_message')->middleware('isUserApprove');
Route::post('/message/{type}','messageController@message');



Route::post('/supplier_referral/{id}','referralController@referral')->middleware('isUserApprove');

Route::get('/logout', function ()
{
    auth()->logout();
    Session()->flush();

    return Redirect::to('/login');
})->name('logout');
