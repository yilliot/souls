<?php

namespace App\Models\Session;

use Illuminate\Database\Eloquent\Model;

class SessionVenue extends Model
{
    protected $table = 'session_venues';

    // GET
    public function __tostring()
    {
        return $this->name;
    }

    // REL
    public function sessions()
    {
        return $this->hasMany(Session::class, 'venue_id');
    }
}