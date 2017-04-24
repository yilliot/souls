<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index');
Route::get('/applink', function(){ return view('welcome'); });

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {

    Route::get('/login', 'LoginController@showLoginForm')->name('login');
    Route::post('/login', 'LoginController@login');
    Route::post('/logout', 'LoginController@logout')->name('logout');

    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')
        ->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset')
        ->name('password.request');
    Route::get('verify_email/{code}', 'VerifyEmailController@verifyEmail')
        ->name('auth.verify_email');
});
Route::group(['prefix' => 'cgl', 'namespace' => 'Cgl',
    'middleware' => 'cgl.admin'
    ], function () {
    Route::get('/', 'DashboardController@index');
    Route::group(['prefix' => 'job'], function(){
        Route::get('/', 'JobsController@index');
        Route::get('/{id}', 'JobsController@get');
        Route::post('/approve/{id}', 'JobsController@postApprove');
        Route::get('/reject/{id}', 'JobsController@reject');
        Route::post('/reject/{id}', 'JobsController@postReject');
    });
    Route::group(['prefix' => 'seller'], function(){
        Route::get('/', 'SellersController@index');
        Route::get('verify/{id}', 'SellersController@verify');
        Route::post('verify/{id}', 'SellersController@postVerify');
    });
});
