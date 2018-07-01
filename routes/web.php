<?php
Route::get('/calendar', 'HomeController@calendar');
Route::get('/privacy', 'LegalController@privacy');
Route::get('/terms', 'LegalController@terms');

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
Route::get('/i/todo', function(){
    return view('todo');
});

Route::group(['prefix' => 'event', 'namespace' => 'Event'], function () {

    Route::group(['prefix' => 'vote', 'namespace' => 'Vote'], function () {

        // Route::get('/supreme', 'SupremeController@s01');
        // Route::post('/supreme', 'SupremeController@postS01');
        // Route::get('/supreme/message', 'SupremeController@message');

    });

    Route::get('/3km', 'JustBeginController@home');
    Route::get('/3km/signup', 'JustBeginController@signup');
    Route::post('/3km/signup', 'JustBeginController@postSignup');
    Route::get('/3km/checkin', 'JustBeginController@checkin');
    Route::post('/3km/checkin', 'JustBeginController@postCheckin');
    Route::get('/3km/recorded/{id}', 'JustBeginController@recorded');
    Route::get('/3km/validation', 'JustBeginController@validation');
    Route::get('/3km/search_claim', 'JustBeginController@searchClaim');
    Route::get('/3km/admin_search_claim', 'JustBeginController@adminSearchClaim');
    Route::get('/3km/claim', 'JustBeginController@claim');
    Route::post('/3km/claim', 'JustBeginController@postClaim');

    Route::group(['prefix' => 'bible_reading', 'namespace' => 'BibleReading'], function () {

        Route::get('/', 'BibleReadingController@home');
        Route::get('/signup', 'BibleReadingController@signup');
        Route::get('/checkin', 'BibleReadingController@checkin');
        Route::group(['middleware' => 'nric'], function() {
            Route::get('/history', 'BibleReadingController@history');
            Route::get('/history/{book}/{verse}', 'BibleReadingController@showHistory');
            Route::get('/history/my', 'BibleReadingController@showMyHistory');
        });
        Route::get('/nric', 'BibleReadingController@nric');
        Route::get('/logout', 'BibleReadingController@logout');

        Route::post('/signup', 'BibleReadingController@postSignup');
        Route::post('/checkin', 'BibleReadingController@postCheckin');
        Route::post('/history', 'BibleReadingController@postHistory');
        Route::post('/nric', 'BibleReadingController@postNric');

        Route::get('/schedule', 'BibleReadingController@getSchedule');
    });
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

