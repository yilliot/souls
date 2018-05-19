<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Welcome\ChatRecord;
use App\Models\Welcome\Followupper;
use App\Models\Welcome\FollowupComment;

class Soul extends Model
{
    protected $table = 'souls';

    public function __toString()
    {
        return $this->nickname;
    }

    // REL
    public function ministries()
    {
        return $this->belongsToMany(Ministry::class, 'ministry_souls', 'soul_id', 'ministry_id');
    }
    public function cellgroup()
    {
        return $this->belongsTo(Cellgroup::class, 'cellgroup_id');
    }
    public function chatRecord()
    {
        return $this->hasOne(ChatReord::class, 'nc_id');
    }
     public function accompanionRecord()
    {
        return $this->hasMany(ChatReord::class, 'accompanion_id');
    }
     public function followupComment()
    {
        return $this->hasMany(FollowupComment::class, 'followupper_id');
    }
    public function followupper()
    {
        return $this->hasMany(Followupper::class, 'followupper_id');
    }
}