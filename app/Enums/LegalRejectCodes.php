<?php

namespace App\Enums;

final class LegalRejectCodes extends Enum
{
    const NOT_CLEAR = 1;
    const DAMAGED = 2;
    const NOT_MEET_REQUIREMENT = 3;

    static function map()
    {
        // 1001: The photo is not clear, please retake with clear viewing.
        // 1002: The ID in the photo is damaged, please provide intact ID in the photo.
        // 1003: The provided ID does not meet the requirement, please provide photo of original NRIC or passport with legal work permit.

        return [
            self::NOT_CLEAR => 'is not clear, please retake with clear viewing.',
            self::DAMAGED => 'in the photo is damaged, please provide intact ID in the photo',
            self::NOT_MEET_REQUIREMENT => 'does not meet the requirement, please provide photo of original NRIC or passport with legal work permit.',
        ];
    }
}