<?php
Route::get('/calendar', 'HomeController@calendar');
Route::get('/privacy', 'LegalController@privacy');
Route::get('/terms', 'LegalController@terms');

Route::group(['prefix' => 'telegram-bot', 'namespace' => 'TelegramBot'], function () {
    Route::post('/', function(\Illuminate\Http\Request $request) {
        \Log::info($request->all());
    });
});

## FutureFund
Route::group(['prefix' => 'ff', 'namespace' => 'FutureFund'], function () {
    Route::get('/{ff_code}', 'MemberController@index');
    Route::get('/{ff_code}/{pledge_code}', 'MemberController@show');
    Route::get('/{ff_code}/{pledge_code}/payment', 'MemberController@getPaymentForm');
    Route::post('/{ff_code}/{pledge_code}/payment', 'MemberController@postPaymentForm');
});

## FORECAST
Route::group(['prefix' => 'attendance', 'namespace' => 'Attendance', 'middleware' => 'auth'], function () {
    Route::get('/', 'ForecastController@index'); // redirect
    Route::get('/forecast/services', 'ForecastController@getServices'); // list services
    Route::get('/forecast/service/{id}', 'ForecastController@getService'); // action
    Route::get('/forecast/service/{id}/guests', 'ForecastController@getGuests'); // guests
});


Route::get('/', 'HomeController@welcome');
Route::get('/i/', function(){
    $data = [
        'chat_id' => 'yilliot',
        'text'    => 'hi',
    ];
    $response = Telegram::getUpdates([
        // 'offset' => '320308637',
        'allowed_updates' => ['message', 'edited_message', 'channel_post', 'edited_channel_post', 'inline_query']
    ]);

    dd($response);
    $request = collect(end($response)); // fetch the last request from the collection

    $chatid = $request['message']['chat']['id']; // get chatid from request
    $text = $request['message']['text']; // get the user sent text
    $response = Telegram::sendMessage([
        'chat_id' => $chatid, 
        'text' => 'Hey! This is bot sending you the first message :)'
    ]);
    dd($response);
});

Route::group(['prefix' => 'event', 'namespace' => 'Event'], function () {

});

## SESSION
Route::group(['prefix' => 'session', 'namespace' => 'Session'], function () {
    Route::get('/lang/zh', 'LocaleController@zh');
    Route::get('/lang/en', 'LocaleController@en');
});

## AUTH
Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {

    Route::get('/signup', 'RegisterController@showRegistrationForm');
    Route::post('/signup', 'RegisterController@postRegistrationForm');
    Route::get('/login', 'LoginController@showLoginForm')->name('login');
    Route::post('/login', 'LoginController@postLoginForm');
    Route::get('/signup/nric', 'RegisterController@getMergeNric');
    Route::post('/signup/nric', 'RegisterController@postMergeNric');

    Route::get('/merge/nric', 'LoginController@getMergeNric');
    Route::post('/merge/nric', 'LoginController@postMergeNric');
    Route::post('/logout', 'LoginController@logout')->name('logout');

    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')
        ->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset')
        ->name('password.request');
    Route::get('verify_email/{code}', 'VerifyEmailController@verifyEmail')
        ->name('auth.verify_email');

    ### Facebook
    Route::get('/facebook', 'FacebookLoginController@redirectToProvider');
    Route::get('/facebook/callback', 'FacebookLoginController@handleProviderCallback');
});


## Admin
Route::group(['prefix' => 'admin', 'namespace' => 'Admin',
     'middleware' => 'admin'
    ], function () {
        Route::get('service/{service}/attendance', 'AttendanceController@index');
        Route::group(['prefix' => 'attendance'], function() {
            // forecast
            Route::post('add', 'AttendanceController@postAdd');
            Route::post('delete', 'AttendanceController@postDelete');
            // attendance
            Route::post('attended', 'AttendanceController@postAttended');
            Route::post('reset', 'AttendanceController@postReset');

            Route::get('/{attendance_id}/visitor', 'AttendanceController@visitor');
            Route::post('visitor', 'AttendanceController@postVisitor');
            Route::delete('visitor', 'AttendanceController@postDeleteVisitor');
        });

        Route::resource('service', 'ServiceController');
        Route::resource('soul', 'SoulController');
});

## CGL
Route::group(['prefix' => 'cgl', 'namespace' => 'Cgl',
     'middleware' => 'cgl'
    ], function () {
        Route::resource('soul', 'SoulController');
});

