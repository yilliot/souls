<?php
namespace App\Services;

class Prefixer
{
    private $prefixes;
    private $length;

    public function __construct()
    {
        $this->prefixes = [
            'App\Models\User' => 'U',
            'App\Models\Service' => 'S',
            'App\Models\Soul' => 'P',
        ];
        $this->length = 5;
    }

    public function wrap($target)
    {
        return $this->getPrefix($target) . str_pad(
            $target->id,
            $this->length,
            '0',
            STR_PAD_LEFT
        );
    }

    public function unwrap($string)
    {
        // numeric only
        if (
            strlen($string) < $this->length &&
            is_numeric(substr($string, 0, 1))) {
            return ltrim($string, '0');
        }

        // fullprefix
        foreach ($this->prefixes as $prefix) {
            if (starts_with($string, $prefix)) {
                return ltrim(substr($string, strlen($prefix)), '0');
            }
        }
        return $string;
    }

    private function getPrefix($target)
    {
        $className = get_class($target);
        return isset($this->prefixes[$className]) ? $this->prefixes[$className] : null;
    }
}
