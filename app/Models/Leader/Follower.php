<?php

namespace App\Models\Leader;

use Illuminate\Database\Eloquent\Model;
use App\Models\Soul;

class Follower extends Model
{
    protected $table = 'soul_leader_followers';

    public function __toString()
    {
        return $this->leader;
    }

    // REL
    public function leader()
    {
        return $this->hasMany(Soul::class, 'leader_id');
    }
    public function follower()
    {
        return $this->belongsTo(Soul::class, 'follower_id');
    }
}