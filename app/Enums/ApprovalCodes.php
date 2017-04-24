<?php

namespace App\Enums;

final class ApprovalCodes extends Enum
{
    const PENDING = 0;
    const APPROVED = 1;
    const REJECTED = 2;

    static function map()
    {
        return [
            self::PENDING => 'Pending',
            self::APPROVED => 'Approved',
            self::REJECTED => 'Rejected',
        ];
    }
}