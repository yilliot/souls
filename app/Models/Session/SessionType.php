<?php

namespace App\Models\Session;

use Illuminate\Database\Eloquent\Model;

class SessionType extends Model
{
    protected $table = 'session_types';

    // GET
    public function __tostring()
    {
        return $this->name;
    }

    // REL
    public function sessions()
    {
        return $this->hasMany(Session::class, 'type_id');
    }
}