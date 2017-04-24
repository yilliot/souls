<?php

namespace App\Enums;

final class JobRejectCodes extends Enum
{
    const NOT_CLEAR = 1;
    const VIOLENT_SEXUAL = 2;
    const SENSITIVE_DISCRIMINATORY = 3;
    const NOT_MATCH_CONTENT = 4;
    const TOO_SHORT = 5;
    const UNREASONABLE = 6;
    const PROHIBITED = 7;
    const BLUR_PHOTO = 8;

    static function map()
    {
        return [
            self::NOT_CLEAR => 'not clear',
            self::VIOLENT_SEXUAL => 'violent or sexual',
            self::SENSITIVE_DISCRIMINATORY => 'sensitive or discriminatory',
            self::NOT_MATCH_CONTENT => 'not match with content',
            self::TOO_SHORT => 'too short',
            self::UNREASONABLE => 'unreasonable',
            self::PROHIBITED => 'not allow',
            self::BLUR_PHOTO => 'blur photo',
        ];
    }
}