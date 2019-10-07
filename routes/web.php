<?php
use Illuminate\Http\Request;
use App\Http\Middleware\isCurrentInvoice;

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

Route::get('/r', function() {
//$radis = app()->make('redis');
//Cache::set('key','amar');
//
//return Cache::get('key');
    $rates = new \App\CacheStore\Rates();
    return $rates->model();
});

Route::get('/clear-cache', function() {

    Artisan::call('cache:clear');
    return "Cache is cleared";
});



Route::get('/kala','RequestController@demoStore');
Route::get('/test2', function(Request $request) {

    return config('currency');

});


Route::group(['prefix' => 'experiment'], function(){
    Route::get('/','ExperimentController@testFun');
    Route::get('/paymentable/get','ExperimentController@getPaymentable');
    Route::get('/paymentable/set','ExperimentController@setPaymentable');
    Route::get('/empty-order/get','ExperimentController@getEmptyOrder');
    Route::get('/empty-order/set','ExperimentController@setEmptyOrder');
    Route::get('/demand','ExperimentController@onDemand');

});

Route::get('/dashboard','DashboardController@index')->name('dashboard');
Route::get('/','HomeController@wireTest')->name('home');

Route::group(['prefix' => 'requests'], function(){
    Route::get('/','HomeController@wireTest')->name('request.wireTest');
    Route::get('/create','HomeController@index')->name('request.create');
    Route::get('/store','RequestController@store')->name('request.store');
    Route::get('{id}/show','RequestController@show')->name('request.show');

});

Route::group(['prefix' => 'genaral'], function()
{
    Route::get('/','HomeController@index')->name('genaral.home');
    Route::get('/pending','PendingController@index')->name('genaral.pending');
});

Route::group(['prefix' => 'history'], function()
{

    Route::get('/success','SuccessController@index')->name('history.success');
    Route::get('/success/search','SuccessController@search')->name('history.success.search');
    Route::get('/success/recent-active','SuccessController@recentActive')->name('history.recentActive');


    Route::get('/vendor','CustomerController@index')->name('history.vendor');
});


Route::group(['prefix' => 'vendors'], function()
{

    Route::get('/','VendorController@index')->name('vendor');
    Route::get('/{id}/show','VendorController@show')->name('vendor.show');
    Route::post('/store','VendorController@store')->name('vendor.store');
    Route::get('/create','VendorController@create')->name('vendor.create');
    Route::get('/{id}/payment','VendorController@payment')->name('vendor.payment');

});

Route::group(['prefix' => 'customer'], function()
{

    Route::get('/','CustomerController@index')->name('customer');
    Route::get('/create','CustomerController@create')->name('customer.create');
    Route::post('/store','CustomerController@store')->name('customer.store');
    Route::get('/{id}/show','CustomerController@show')->name('customer.show');
    Route::get('/filter','CustomerController@customerFilter')->name('customer.filter');

    Route::get('/repayable','RepayableCustomerController@index')->name('repayable');
    Route::get('/{customerid}/repayable/create','RepayableCustomerController@create')->name('repayable.create');
    Route::get('/{customerid}/repayable/store','RepayableCustomerController@store')->name('repayable.store');

});

Route::group(['prefix' => 'payment'], function()
{
    Route::get('/xxxxxx','PaymentController@orderPaymentStore')->name('payment.orderPayStore');
    Route::get('/{id}/edit','RequestController@edit')->name('payment.edit');
//Route::get('/{id}/change-amount','PaymentController@edit')->name('payment.changeAmount');
//Route::get('/{id}/updatepayment','PaymentController@update')->name('payment.updatepayment');

//Route::get('/{id}/update','RequestController@update')->name('payment.update');
    Route::get('/{id}/remove-confirm','PendingController@confirmDestroy')->name('payment.removeConfirm');
    Route::get('/{id}/remove','PaymentController@destroy')->name('payment.remove');

});
Route::group(['prefix' => 'change-and-edit'], function()
{
    Route::get('/{payId}/edit-amount','PaymentController@editAmount')
        ->name('changeEdit.editAmount');

    Route::get('/{payId}/update-amount','PaymentController@updateAmount')
        ->name('changeEdit.updateAmount');

    Route::get('/{payId}/edit-bill','PaymentController@editBill')
        ->name('changeEdit.editBill');
    Route::get('/{payId}/update-bill','PaymentController@updateBill')
        ->name('changeEdit.updateBill');

    Route::get('/{payId}/change-vendor','PaymentController@changeVendor')
        ->name('changeEdit.changeVendor');

    Route::get('/{payId}/update-vendor-change','PaymentController@changeVendorUpdate')
        ->name('changeEdit.changeVendorUpdate');

    Route::get('/{vendorId}/edit-vendor','VendorController@editVendor')
        ->name('changeEdit.editVendor');

    Route::get('/{vendorId}/edit-vendor-update','VendorController@editVendorUpdate')
        ->name('changeEdit.editVendorUpdate');

    Route::get('/{payId}/change-order','PaymentController@changeOrder')
        ->name('changeEdit.changeOrder');
    Route::get('/{payId}/change-order-update','PaymentController@changeOrder')
        ->name('changeEdit.changeOrderUpdate');

    Route::get('/{payId}/change-customer','PaymentController@changeCustomer')
        ->name('changeEdit.changeCustomer');

    Route::get('/{payId}/update-customer','PaymentController@changeCustomerUpdate')
        ->name('changeEdit.changeCustomerUpdate');

    Route::get('/{orderId}/edit-order','OrderController@editOrder')
        ->name('changeEdit.editOrder');
    Route::get('/{orderId}/edit-order-update','OrderController@editOrderUpdate')
        ->name('changeEdit.editOrderUpdate');

    Route::get('/{customerId}/edit-customer','CustomerController@editCustomer')
        ->name('changeEdit.editCustomer');

    Route::get('/{customerId}/edit-update-customer','CustomerController@updateCustomer')
        ->name('changeEdit.editCustomerUpdate');


});

Route::group(['prefix' => 'rate'], function()
{

    Route::get('/','RateController@index')->name('rate');

    Route::get('/{tariffId}/createRate','RateController@create')->name('rate.create');

    Route::get('/bank-rate/create','RateController@addBankRate')
        ->name('rate.bankRate.create');

    Route::get('/bank-rate/set','RateController@setBankRate')
        ->name('rate.setBankRate');
    Route::get('/{tariffId}/store','RateController@store')->name('rate.store');
    Route::get('/{id}/edit','RateController@edit')->name('rate.edit');
    Route::get('/{tariffId}/{id}/update','RateController@update')->name('rate.update');
    Route::get('/{id}/remove','RateController@destroy')->name('rate.remove');

});


Route::group(['prefix' => 'option'], function()
{

    Route::get('/{params}','OptionController@index')
        ->where(['params' => '[layout||repayable||currentrate]+'])->name('option');
    Route::get('/store/repayable','OptionController@storeRepayable')->name('option.store.repayable');
    Route::get('/remove','OptionController@destroy')->name('option.remove');

});


Route::group(['prefix' => 'report'], function()
{

    Route::get('/order','ReportController@orderReport')->name('report.order');
    Route::get('/credit','ReportController@creditReport')->name('report.credit');
    Route::get('/debit','ReportController@debitReport')->name('report.debit');
    Route::get('/customer','ReportController@customerReport')->name('report.customer');

    Route::get('/customer/filter','ReportController@customerReportFilter')->name('report.customer.filter');
    Route::get('/order/filter','ReportController@orderReportFilter')->name('report.order.filter');
    Route::get('/credit/filter','ReportController@creditReportFilter')->name('report.credit.filter');
    Route::get('/debit/filter','ReportController@debitReportFilter')->name('report.debit.filter');

});

Route::group(['prefix' => 'invoice'], function()
{

    Route::get('/','InvoiceController@index')->name('invoice');
    Route::get('/genarate','InvoiceController@genarate')->name('invoice.genarate');
    Route::post('/publish','InvoiceController@publish')->name('invoice.publish');
    Route::get('/{type}/{id}/show','InvoiceController@show')->name('invoice.show');
    Route::get('/{type}/{id}/pdf','InvoiceController@generatePDF')->name('invoice.pdf');
    Route::get('/{type}/{id}/{payId}/pull','InvoiceController@pullPayment')->name('invoice.pull')->middleware(isCurrentInvoice::class);
    Route::get('/{type}/{id}/{payId}/push','InvoiceController@pushPayment')->name('invoice.push')->middleware(isCurrentInvoice::class);


});

Route::group(['prefix' => 'tariff'], function()
{

    Route::get('/','TariffController@index')->name('tariff');
    Route::get('/create','TariffController@create')->name('tariff.create');
    Route::get('/store','TariffController@store')->name('tariff.store');
    Route::get('/{id}/show','TariffController@show')->name('tariff.show');
    Route::get('/{id}/edit','TariffController@edit')->name('tariff.edit');
    Route::get('/{id}/destroy','TariffController@destroy')->name('tariff.remove');



});
