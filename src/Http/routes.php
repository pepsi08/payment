<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::get('/', 'ivanchenko\payment\http\controllers\PaymentController@index');

    Route::post('/payment-success', function () {
        return view('payment::success', ['success' => true]);
    });

    Route::post('/validate/payment', [
        'as' => 'validate-payment',
        'uses' => 'ivanchenko\payment\http\controllers\PaymentValidationController@validatePaymentData'
    ]);
});
