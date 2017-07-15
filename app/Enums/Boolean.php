<?php

namespace App\Enums;

final class Boolean extends Enum
{
    const YES = 1;
    const NO = 0;

    static function map()
    {
        return [
            self::YES => 'Yes',
            self::NO => 'No',
        ];
    }
}