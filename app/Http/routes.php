<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/test', function () {
    return view('welcome');
});

Route::auth();

Route::get('/', 'HomeController@index');
Route::get('/order/{id}/edit', 'HomeController@edit');
Route::put('/order/user/{id}', 'HomeController@updateUser');
Route::put('/order/admin/{id}', 'HomeController@updateAdmin');

Route::get('/search', 'SearchController@index');
Route::get('/search/ticket-id', 'SearchController@ticketId');
Route::get('/search/date-wise', 'SearchController@dateWise');
Route::get('/search/phone-number-wise', 'SearchController@phoneNumberWise');

Route::get('/report/delivery-status-form', 'ReportController@deliveryStatusForm');
Route::get('/report/delivery-status-forms', 'ReportsController@deliveryStatusForm');
Route::get('/report/delivery-status-show', 'ReportController@deliveryStatusShow');


Route::get('/clear-cache', function()
{
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    Artisan::call('view:clear');

    return "Cleared!";
});