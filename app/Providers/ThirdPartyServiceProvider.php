<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Twilio\Rest\Client as TwilioClient;

class ThirdPartyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('twilio', function ($app) {
            return new TwilioClient(config('twilio.account_sid'), config('twilio.auth_token'));
        });
    }
}
