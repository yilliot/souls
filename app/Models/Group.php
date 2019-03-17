<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'cellgroups';

    public function __toString()
    {
        return $this->name;
    }

    // GET
    public function getColorAttribute()
    {
        switch ($this->id) {
            case 1: $color = 'red'; break;
            case 2: $color = 'green'; break;
            case 3: $color = 'blue'; break;
            case 4: $color = 'yellow'; break;
        }
        return $color;
    }

    // REL
    public function leader()
    {
        return $this->belongsTo(Soul::class, 'leader_id');
    }
    public function colead1()
    {
        return $this->belongsTo(Soul::class, 'colead1_id');
    }
    public function colead2()
    {
        return $this->belongsTo(Soul::class, 'colead2_id');
    }

    public function members()
    {
        return $this->hasMany(Soul::class, 'cellgroup_id');
    }

    public function scopeActive()
    {
        return $this->where('is_active', true);
    }

}