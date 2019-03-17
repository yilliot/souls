<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Leader\Follower;

class Soul extends Model
{
    protected $table = 'souls';

    public function __toString()
    {
        return $this->nickname;
    }

    // REL
    public function leaders()
    {
        return $this->belongsToMany(Soul::class, 'soul_leader_followers', 'follower_id', 'leader_id');
    }
    public function followers()
    {
        return $this->belongsToMany(Soul::class, 'soul_leader_followers', 'leader_id', 'follower_id');
    }
    public function ministries()
    {
        return $this->belongsToMany(Ministry::class, 'ministry_souls', 'soul_id', 'ministry_id');
    }
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_souls', 'soul_id', 'group_id');
    }
    public function user()
    {
        return $this->hasOne(User::class);
    }
    public function pledges()
    {
        return $this->hasMany(FutureFund\Pledge::class);
    }

}