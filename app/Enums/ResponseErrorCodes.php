<?php

namespace App\Enums;

final class ResponseErrorCodes extends Enum
{
    const PHONE_EXISTED = 1011;
    const PHONE_VERIFY_FAILED = 1012;
    const FACEBOOK_VERIFY_FAILED = 1023;
    const LEGAL_ID_NOT_REJECTED = 2001;

    static function map()
    {
        return [
            self::PHONE_EXISTED => 'phone existed',
            self::PHONE_VERIFY_FAILED => 'phone failed to verify',
            self::FACEBOOK_VERIFY_FAILED => 'facebook failed to verify',
            self::LEGAL_ID_NOT_REJECTED => 'Legal ID is not rejected',
        ];
    }
}