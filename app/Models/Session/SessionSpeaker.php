<?php

namespace App\Models\Session;

use Illuminate\Database\Eloquent\Model;

class SessionSpeaker extends Model
{
    protected $table = 'session_speakers';

    public function __tostring()
    {
        return $this->name;
    }

    // REL
    public function sessions()
    {
        return $this->hasMany(Session::class, 'speaker_id');
    }
}