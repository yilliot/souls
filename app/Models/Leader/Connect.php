<?php

namespace App\Models\Leader;

use Illuminate\Database\Eloquent\Model;

class Connect extends Model
{
    protected $table = 'soul_connects';

    public function __toString()
    {
        return $this->leader;
    }

    // REL
    public function leader()
    {
        return $this->belongsTo(Soul::class, 'leader_id');
    }
}