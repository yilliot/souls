<?php

namespace App\Enums;

final class AreaStates extends Enum
{
    const JOHOR = 1010000;
    const KEDAH = 1020000;
    const KELANTAN = 1030000;
    const MALACCA = 1040000;
    const NEGERI = 1050000;
    const PAHANG = 1060000;
    const PERAK = 1070000;
    const PERLIS = 1080000;
    const PENANG = 1090000;
    const SABAH = 1100000;
    const SARAWAK = 1110000;
    const SELANGOR = 1120000;
    const TERENGGANU = 1130000;

    static function map()
    {
        /**
         * 1xxxxxx Malaysia
         * x00xxxx State
         * xxx00xx District
         * xxxxx00 Area
         */
        return [
            self::JOHOR => "Johor",
            self::KEDAH => "Kedah",
            self::KELANTAN => "Kelantan",
            self::MALACCA => "Malacca",
            self::NEGERI => "Negeri",
            self::PAHANG => "Pahang",
            self::PERAK => "Perak",
            self::PERLIS => "Perlis",
            self::PENANG => "Penang",
            self::SABAH => "Sabah",
            self::SARAWAK => "Sarawak",
            self::SELANGOR => "Selangor",
            self::TERENGGANU => "Terengganu",
        ];
    }

    static function fullnames()
    {
        return [
            self::JOHOR => "Johor Darul Ta'zim",
            self::KEDAH => "Kedah Darul Aman",
            self::KELANTAN => "Kelantan Darul Naim",
            self::MALACCA => "Malacca",
            self::NEGERI => "Negeri Sembilan Darul Khusus",
            self::PAHANG => "Pahang Darul Makmur",
            self::PERAK => "Perak Darul Ridzuan",
            self::PERLIS => "Perlis Indera Kayangan",
            self::PENANG => "Penang",
            self::SABAH => "Sabah",
            self::SARAWAK => "Sarawak",
            self::SELANGOR => "Selangor Darul Ehsan",
            self::TERENGGANU => "Terengganu Darul Iman",
        ];
    }
}