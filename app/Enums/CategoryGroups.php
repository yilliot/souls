<?php

namespace App\Enums;

final class CategoryGroups extends Enum
{
    const BEAUTY = 100;
    const HEALTH_FITNESS = 200;
    const PERSONAL_DEVELOPMENT = 300;
    const CONSULTATION = 400;
    const WEDDING_EVENTS = 500;
    const HOUSEHOLD = 600;
    const INFLUENCER = 700;
    const OTHERS = 800;

    static function map()
    {
        return [
            self::BEAUTY => 'Beauty',
            self::HEALTH_FITNESS => 'Health & Fitness',
            self::PERSONAL_DEVELOPMENT => 'Personal Development',
            self::CONSULTATION => 'Consultation',
            self::WEDDING_EVENTS => 'Wedding & Events',
            self::HOUSEHOLD => 'Household',
            self::INFLUENCER => 'Influencer',
            self::OTHERS => 'Others',
        ];
    }

    public function getCategories()
    {
        $reflector = new \ReflectionClass(Categories::class);
        return collect(array_reduce($reflector->getConstants(),
                    function($carry, $id){
                        if((int)floor($id/100)*100 === $this->enumID)
                            array_push($carry, $id);
                        return $carry;
                    }, []));
    }
}