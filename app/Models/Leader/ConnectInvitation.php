<?php

namespace App\Models\Leader;

use Illuminate\Database\Eloquent\Model;

class ConnectInvitation extends Model
{
    protected $table = 'soul_connect_invitations';

    public function __toString()
    {
        return $this->leader;
    }

    // REL
    public function connect()
    {
        return $this->belongsTo(Connect::class, 'soul_connect_id');
    }
    public function invitee()
    {
        return $this->belongsTo(Soul::class, 'soul_id');
    }

}