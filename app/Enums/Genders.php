<?php

namespace App\Enums;

final class Genders extends Enum
{
    const MALE = 0;
    const FEMALE = 1;
    const UNSPECIFIED = 99;

    static function map()
    {
        return [
            self::MALE => 'Male',
            self::FEMALE => 'Female',
            self::UNSPECIFIED => 'Unknown',
        ];
    }
}