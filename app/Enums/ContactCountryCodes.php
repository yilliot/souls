<?php

namespace App\Enums;

final class ContactCountryCodes extends Enum
{
    const MY = 60;
    const SG = 65;

    static function map()
    {
        return [
            self::MY => 'Malaysia +60',
            self::SG => 'Singapore +65',
        ];
    }
}