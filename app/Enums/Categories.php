<?php

namespace App\Enums;

final class Categories extends Enum
{
    /**
     * X.Y.Z
     * Z : image update
     * Y : category update
     * X : category group update
     */
    const VERSION = '1.1.1';

    const BE_ENHANCEMENT = 101;
    const BE_MAKEUP = 102;
    const BE_TATTOO = 103;
    const BE_HAIR = 104;
    const BE_MANICURE_PEDICURE = 105;

    const HF_DANCE_YOGA = 201;
    const HF_SPORTS = 202;
    const HF_GYM = 203;
    const HF_TREATMENT_THERAPY = 204;
    const HF_DIET_NUTRITION = 205;

    const PD_TUITION = 301;
    const PD_LANGUAGE = 302;
    const PD_IT_PROGRAMMING = 303;
    const PD_ART_DESIGN = 304;
    const PD_MUSIC_SINGING = 305;

    const CO_IT_PROGRAMMING = 401;
    const CO_ART_DESIGN = 402;
    const CO_LAW = 403;
    const CO_MARKETTING = 404;
    const CO_FINANCE = 405;

    const WE_EMCEE = 501;
    const WE_FLORIST = 502;
    const WE_HELPER = 503;
    const WE_LUXURY_CAR_RENTAL = 504;
    const WE_PHOTOGRAPHY_VIDEOGRAPHY = 505;

    const HO_AIRCON_PLUMBING = 601;
    const HO_ELECTRONICS_ELECTRICAL = 602;
    const HO_CLEANING_WASHING = 603;
    const HO_COOK = 604;
    const HO_PEST_CONSTROL = 605;

    const IN_BLOGGER = 701;
    const IN_SINGER = 702;
    const IN_MODEL = 703;
    const IN_MEDIA = 704;
    const IN_PERFORMER = 705;

    const OT_GAMES = 801;
    const OT_TRAVEL_PLANNER = 802;
    const OT_RANDOM_ACTS = 803;
    const OT_PERSONAL_DRIVER = 804;
    const OT_RUNNER = 805;


    static function map()
    {
        return [
            self::BE_ENHANCEMENT => 'Enhancement',
            self::BE_MAKEUP => 'Make Up',
            self::BE_TATTOO => 'Tattoo',
            self::BE_HAIR => 'Hair',
            self::BE_MANICURE_PEDICURE => 'Manicure & Pedicure',

            self::HF_DANCE_YOGA => 'Dance & Yoga',
            self::HF_SPORTS => 'Sports',
            self::HF_GYM => 'Gym',
            self::HF_TREATMENT_THERAPY => 'Treatment & Therapy',
            self::HF_DIET_NUTRITION => 'Diet & Nutrition',

            self::PD_TUITION => 'Tuition',
            self::PD_LANGUAGE => 'Language',
            self::PD_IT_PROGRAMMING => 'IT & Programming',
            self::PD_ART_DESIGN => 'Art & Design',
            self::PD_MUSIC_SINGING => 'Music & Singing',

            self::CO_IT_PROGRAMMING => 'IT & Programming',
            self::CO_ART_DESIGN => 'Art & Design',
            self::CO_LAW => 'LAW',
            self::CO_MARKETTING => 'Marketing',
            self::CO_FINANCE => 'Finance',

            self::WE_EMCEE => 'Emcee & DeeJay',
            self::WE_FLORIST => 'Florist',
            self::WE_HELPER => 'Helper',
            self::WE_LUXURY_CAR_RENTAL => 'Luxury Car Rental',
            self::WE_PHOTOGRAPHY_VIDEOGRAPHY => 'Photography & Videography',

            self::HO_AIRCON_PLUMBING => 'Air-con & Plumbing',
            self::HO_ELECTRONICS_ELECTRICAL => 'Electronics & Electrical',
            self::HO_CLEANING_WASHING => 'Cleaning & Washing',
            self::HO_COOK => 'Cook',
            self::HO_PEST_CONSTROL => 'Pest Control',

            self::IN_BLOGGER => 'Blogger',
            self::IN_SINGER => 'Singer',
            self::IN_MODEL => 'Model',
            self::IN_MEDIA => 'Media',
            self::IN_PERFORMER => 'Performer',

            self::OT_GAMES => 'Games',
            self::OT_TRAVEL_PLANNER => 'Travel Planner',
            self::OT_RANDOM_ACTS => 'Random Acts',
            self::OT_PERSONAL_DRIVER => 'Personal Driver',
            self::OT_RUNNER => 'Runner',
        ];
    }

    public function getGroup()
    {
        return CategoryGroups::getObj(
            floor($this->enumID/100) * 100
            );
    }
}