<?php

namespace App\Services;

use App\Models\User;
use App\Models\PhoneVerification;

class SmsMessenger
{
    protected $twilioSmsMessenger;

    public function __construct(Twilio\SmsMessenger $twilioSmsMessenger)
    {
        $this->twilioSmsMessenger = $twilioSmsMessenger;
    }

    public function sendPhoneVerification($phone)
    {
        PhoneVerification::where('phone', $phone)->delete();
        $phoneVerification = new PhoneVerification();
        $phoneVerification->phone = $phone;
        $phoneVerification->generate();
        $phoneVerification->save();

        $this->twilioSmsMessenger->sendVerification($phoneVerification);

        return [
            'success' => true,
            'data' => [
            ]
        ];
    }
}