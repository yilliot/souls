<?php
Route::get('/calendar', 'HomeController@calendar');
Route::get('/privacy', 'LegalController@privacy');
Route::get('/terms', 'LegalController@terms');

Route::group(['prefix' => 'telegram-bot', 'namespace' => 'TelegramBot'], function () {
    Route::post('/', function(\Illuminate\Http\Request $request) {
        \Log::info($request->all());
    });
});

## Invite Service
Route::group(['prefix' => 'invite', 'namespace' => 'Session'], function () {
    Route::get('/', 'InviteController@index'); // public
    Route::get('/member', 'InviteController@member'); // member
    Route::post('/response', 'InviteController@postResponse'); // member
});

## FutureFund
Route::group(['prefix' => 'ff', 'namespace' => 'FutureFund'], function () {
    Route::post('/simple_soul', 'MemberController@postSimpleSoul');
    Route::get('/{ff_code}/make-pledge-code/{soul}', 'MemberController@getMakePledgeCode')->name('ff.makePledgeCode');
    Route::get('/{ff_code}/landing', 'MemberController@landing');
    Route::get('/{ff_code}', 'MemberController@index');
    Route::get('/{ff_code}/{pledge_code}', 'MemberController@show')->name('ff.show');

    Route::get('/{ff_code}/{pledge_code}/payment', 'MemberController@getPaymentForm');
    Route::post('/{ff_code}/{pledge_code}/payment', 'MemberController@postPaymentForm');
    Route::get('/{ff_code}/{pledge_code}/amount', 'MemberController@getAmountForm');
    Route::post('/{ff_code}/{pledge_code}/amount', 'MemberController@postAmountForm');

    Route::get('/{ff_code}/{pledge_code}/signup', 'MemberController@reSignup');
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

    Route::get('/redirect/nric', 'RedirectController@getNric');
    Route::post('/redirect/nric', 'RedirectController@postNric');

    Route::get('/signup', 'RegisterController@showRegistrationForm');
    Route::post('/signup', 'RegisterController@postRegistrationForm');
    Route::post('/signup/nric', 'RegisterController@postMergeNric');

    Route::get('/login', 'LoginController@showLoginForm')->name('login');
    Route::post('/login', 'LoginController@postLoginForm');

    Route::post('/logout', 'LoginController@logout')->name('logout');

    Route::get('/merge/nric', 'MergeUserController@getMergeNric');
    Route::post('/merge/nric', 'MergeUserController@postMergeNric');

    Route::get('/complete_profile', 'CompleteSoulController@getCompleteSoulForm');
    Route::post('/complete_profile', 'CompleteSoulController@postCompleteSoulForm');

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
        Route::get('/', 'AdminController@index');
        Route::group(['prefix' => 'ff'], function() {
            Route::get('/print', 'FutureFundController@getPrint');
            Route::get('/', 'FutureFundController@index');
            Route::get('/pledge/{pledge_id}', 'FutureFundController@getPledge');
            Route::get('/pledge/update/{pledge_id}', 'FutureFundController@getUpdatePledgeForm');
            Route::post('/pledge/update/{pledge_id}', 'FutureFundController@postUpdatePledgeForm');
            Route::get('/payment/create/{pledge_id}', 'FutureFundController@getCreatePaymentForm');
            Route::post('/payment/create/{pledge_id}', 'FutureFundController@postCreatePaymentForm');
            Route::get('/payment/update/{payment_id}', 'FutureFundController@getUpdatePaymentForm');
            Route::post('/payment/update/{payment_id}', 'FutureFundController@postUpdatePaymentForm');
            Route::get('/{id}', 'FutureFundController@pledgeIndex');
            Route::get('/{id}/pledge/create', 'FutureFundController@getPledgeForm');
            Route::post('/{id}/pledge/create', 'FutureFundController@postPledgeForm');
            Route::get('/{id}/payment/pending', 'FutureFundController@paymentPendingIndex');
        });
        Route::get('session/{session}/attendance', 'AttendanceController@index');
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

        Route::group(['prefix' => 'session'], function() {
            Route::get('/', 'SessionController@index');
            Route::get('add', 'SessionController@getCreateSessionForm');
            Route::post('add', 'SessionController@postCreateSessionForm');
            Route::get('edit/{id}', 'SessionController@getEditSessionForm');
            Route::post('edit/{id}', 'SessionController@postEditSessionForm');
            Route::get('{id}', 'SessionController@getSession');
            Route::get('{id}/invitations', 'SessionController@getInvitations');
            Route::post('{id}/invitations', 'SessionController@postInvitations');
        });

        ## Mgmt CG
        Route::group(['prefix' => 'group'], function() {
            Route::get('/', 'GroupController@index');
            Route::get('create', 'GroupController@getCreateGroupForm');
            Route::post('create', 'GroupController@postCreateGroupForm');
            Route::get('{id}/edit', 'GroupController@getEditGroupForm');
            Route::post('{id}/edit', 'GroupController@postEditGroupForm');
            Route::get('{id}', 'GroupController@show');
        });

        Route::resource('soul', 'SoulController');

        Route::group(['prefix' => 'leader', 'namespace' => 'Leader'], function() {
            Route::group(['prefix' => 'follower'], function() {
                Route::get('/', 'FollowerController@index');
                Route::get('add', 'FollowerController@getAddFollowerForm');
                Route::post('add', 'FollowerController@postAddFollowerForm');
                Route::post('remove', 'FollowerController@postRemoveFollower');
            });
            Route::group(['prefix' => 'connect'], function() {
                Route::get('/', 'ConnectController@index');
                Route::get('add', 'ConnectController@getAddConnectForm');
                Route::post('add', 'ConnectController@postAddConnectForm');
                Route::get('show', 'ConnectController@getShowConnect');
                Route::get('invite', 'ConnectController@getInviteFollowerForm');
                Route::post('invite', 'ConnectController@postInviteFollowerForm');
                Route::get('edit/{id}', 'ConnectController@getEditConnectForm');
                Route::post('edit/{id}', 'ConnectController@postEditConnectForm');
                Route::post('remove', 'ConnectController@postRemoveConnect');
            });
        });

});

## CGL
Route::group(['prefix' => 'cgl', 'namespace' => 'Cgl',
     'middleware' => 'cgl'
    ], function () {
        Route::resource('soul', 'SoulController');
});

