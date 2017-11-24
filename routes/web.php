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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

/* 
General Routes
*/
Route::get('/error', function(){
    return view('error');
});

Route::get('/deny', function () {
    return view('deny');
});

/* 
Client Routes
*/ 
Route::group(['prefix' => 'client'], function () {
    Route::get('/home', 'HomeController@index')->name('clientHome');
    // Ticket Routes
    Route::get('new_ticket', 'TicketsController@create');
    Route::post('new_ticket', 'TicketsController@store');
    Route::get('my_tickets', 'TicketsController@userTickets');
    Route::get('tickets/{ticket_id}', 'TicketsController@show');
    Route::post('comment', 'CommentsController@postComment');
    //Invoice Routes
    Route::get('my_invoices', 'InvoicesController@userInvoices');
    Route::get('invoices/{invoices_id}', 'InvoicesController@show');

});
    

/* 
Technical Routes
*/
Route::group(['prefix' => 'technical', 'middleware' => 'technical'], function () {
    Route::get('/home', 'HomeController@index')->name('techHome');
    //Ticket Routes
    Route::get('tickets', 'TicketsController@index');
    Route::post('close_ticket/{ticket_id}', 'TicketsController@close');
});

/* 
Billing Routes
*/
Route::group(['prefix' => 'billing', 'middleware' => 'billing'], function () {
    Route::get('/home', 'HomeController@index')->name('billingHome');
    //Invoices Routes
    Route::get('new_invoice', 'InvoicesController@create');
    Route::post('new_invoice', 'InvoicesController@store');
    Route::get('invoices', 'InvoicesController@index');
    Route::post('pay_invoice/{$invoice_id}', 'InvoicesController@pay');
});


/* 
Sales Routes
*/
Route::group(['prefix' => 'sales', 'middleware' => 'sales'], function () {
    Route::get('/home', 'HomeController@index')->name('salesHome');
    
});

/* 
Master Routes
*/
Route::group(['prefix' => 'master', 'middleware' => 'master'], function () {
    Route::get('/home', 'HomeController@index')->name('masterHome');
    Route::get('/roles', 'RolesController@index')->name('roles');
    Route::post('/roles', 'RolesController@store');
    Route::post('/roles', 'RolesController@update');
    Route::delete('/roles/{id}', 'RolesController@destroy');
    
});