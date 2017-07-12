<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Baptism extends Model
{
    protected $table = 'baptisms';

    public function __toString()
    {
        return $this->name;
    }
}