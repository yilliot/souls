<?php

Route::get('/', 'HomeController@welcome');

Route::group(['prefix' => 'event', 'namespace' => 'Event'], function () {
    Route::get('/3km', 'JustBeginController@home');
    Route::get('/3km/signup', 'JustBeginController@signup');
    Route::post('/3km/signup', 'JustBeginController@postSignup');
    Route::get('/3km/checkin', 'JustBeginController@checkin');
    Route::post('/3km/checkin', 'JustBeginController@postCheckin');
    Route::get('/3km/recorded/{id}', 'JustBeginController@recorded');
});

## SESSION
Route::group(['prefix' => 'session', 'namespace' => 'Session'], function () {
    Route::get('/lang/zh', 'LocaleController@zh');
    Route::get('/lang/en', 'LocaleController@en');
});

## AUTH
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


## Admin
Route::group(['prefix' => 'admin', 'namespace' => 'Admin',
    // 'middleware' => 'admin'
    ], function () {
        Route::get('service/{service}/attendance', 'AttendanceController@index');
        Route::group(['prefix' => 'attendance'], function() {
            // forecast
            Route::post('add', 'AttendanceController@add');
            Route::post('delete', 'AttendanceController@delete');
            // attendance
            Route::post('attended', 'AttendanceController@attended');
            Route::post('absent', 'AttendanceController@absent');
            
        });
        Route::resource('service', 'ServiceController');
        Route::resource('soul', 'SoulController');
        // Route::group(['prefix' => 'service', 'namespace' => 'Service'], function(){
        // });
});

## CGL
Route::group(['prefix' => 'cgl', 'namespace' => 'Cgl',
    // 'middleware' => 'cgl'
    ], function () {
        Route::resource('soul', 'SoulController');
});

