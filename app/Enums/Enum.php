<?php

namespace App\Enums;

abstract class Enum
{
    protected $enumID;

    private function __construct($const) {
        $this->enumID = $const;
    }

    public function __toString()
    {
        return (string) $this->enumID;
    }

    public function getID()
    {
        return $this->__toString();
    }

    public function getName()
    {
        return static::map()[$this->enumID];
    }

    static function getObj($const)
    {
        $calledClass = get_called_class();
        $obj = new $calledClass($const);
        return $obj;
    }

    static function all()
    {
        return static::map();
    }
    static function flatAll()
    {
        $result = [];
        foreach (static::map() as $id => $name) {
            $result[] = [
                'id' => $id,
                'name' => $name,
            ];
        }
        return $result;
    }

    static function forFilters()
    {
        return (['all' => 'All'] + static::map());
    }
    static function forOptionalForm(Array $filter = null)
    {
        $result =  static::map();
        if (!is_null($filter)) {
            $result = array_only($result, $filter);
        }
        return (['null' => 'None'] + $result);
    }

    static function get($number = null)
    {
        if (is_null($number)) {
            return self::all();
        }
        $map = static::map();
        return (isset($map[$number])) ? $map[$number] : null;
    }

    static function random()
    {
        return array_rand(static::map());
    }
}