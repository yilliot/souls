<?php

namespace App\Services\Twilio;

use Twilio\Rest\Client as TwilioClient;
use App\Models\PhoneVerification;

class SmsMessenger
{
    protected $twilioClient;

    public function __construct(TwilioClient $twilioClient)
    {
        $this->twilioClient = $twilioClient;
    }

    public function sendVerification(PhoneVerification $phoneVerification)
    {
        $message = $phoneVerification->code;

        try {
            $this->twilioClient
                ->messages
                ->create(
                $phoneVerification->phone,
                [
                    "body" => $message,
                    "from" => config('twilio.number'),
                ]
            );
            \Log::info('Message sent to ' . $phoneVerification->phone);
        } catch (TwilioException $e) {
            \Log::error(
                'Could not send SMS notification.' .
                ' Twilio replied with: ' . $e
            );
            throw $e;            
        }
    }

}