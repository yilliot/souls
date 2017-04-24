<?php

namespace App\Enums;

final class AreaDistricts extends Enum
{
    const JOHOR_BAHRU = 1010100;
    const PENANG = 1090100;
    const KUALA_LUMPUR = 1120100;

    static function map()
    {
        return [
            self::JOHOR_BAHRU => 'Johor Bahru',
            self::PENANG => 'Penang',
            self::KUALA_LUMPUR => 'Kuala Lumpur',
        ];
    }
}