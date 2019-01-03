<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    public function user()
    {
        return $this->hasOne(User::class);
    }
    public function pledges()
    {
        return $this->hasMany(FutureFund\Pledge::class);
    }

}