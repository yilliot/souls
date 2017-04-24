<?php

namespace App\Enums;

final class Areas extends Enum
{
    const JOHOR_BAHRU = 1010101;
    const PENANG = 1090101;
    const KUALA_LUMPUR = 1120101;

    static function map()
    {
        return [
            self::JOHOR_BAHRU => 'Johor Bahru',
            self::PENANG => 'Penang',
            self::KUALA_LUMPUR => 'Kuala Lumpur',
        ];
    }

}