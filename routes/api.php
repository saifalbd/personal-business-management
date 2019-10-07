<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'order'], function()
{

    Route::get('/{number}/show','OrderController@show')->name('order.show');
    Route::post('/store','OrderController@store')->name('order.store');
    Route::post('/bill-update','OrderController@billUpdate')->name('order.billUpdate');

});

Route::group(['prefix' => 'customer'], function()
{

Route::get('/{customerName}/order-by-name','CustomerController@findOrderByName');

Route::get('/{customerPhone}/order-by-phone','CustomerController@findOrderByPhone')->name('customer.orderByPhone.search');

  Route::get('/{customerName}/search-by-name','CustomerController@searchByName')->name('customer.search');
   Route::get('/{customerPhone}/search-by-phone','CustomerController@searchByPhone')->name('customer.search');
    Route::post('/get','CustomerController@findByPhone')->name('customer.get');
    Route::post('/store','CustomerController@store')->name('customer.store');


});

Route::group(['prefix' => 'pending'], function()
{

    Route::get('/search','PendingController@search')->name('pending.search');
    Route::get('/{id}/update/{role}','PendingController@update')->name('pending.update');

});

Route::group(['prefix' => 'success'], function()
{

    Route::get('/search','SuccessController@search')->name('success.search');

});
Route::group(['prefix' => 'vendors'], function()
{
    Route::get('{vendorId}/credit','VendorController@apiGetCredits')->name('vendor.credits');
    Route::get('{vendorId}/debit','VendorController@apiGetDebits')->name('vendor.debits');

});

Route::group(['prefix' => 'rates'], function()
{
    Route::get('/rate','CustomerController@rates')->name('rates');
    Route::post('/convert','CustomerController@ratesConvert')->name('rates.convert');

});
