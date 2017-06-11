<?php

Route::get('/', 'HomeController@welcome');

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

## CGL
Route::group(['prefix' => 'cgl', 'namespace' => 'Cgl',
    'middleware' => 'cgl.admin'
    ], function () {
});

## USHER
Route::group(['prefix' => 'cgl', 'namespace' => 'Cgl',
    'middleware' => 'usher.admin'
    ], function () {
});
