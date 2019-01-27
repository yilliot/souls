<?php

namespace App\Models\Events;

use Illuminate\Database\Eloquent\Model;
use App\Models\Soul;
use App\Models\CG;

class JustBeginRecord extends Model
{
    protected $table = 'e01_just_begin_records';

    // GET
    public function getPaceAttribute()
    {
        return $this->minutes / ($this->meters/1000);
    }
    public function getSpeedAttribute()
    {
        return  ($this->meters/1000) / ($this->minutes/60);
    }

    // REL
    public function soul()
    {
        return $this->belongsTo(Soul::class, 'soul_id');
    }
    public function cellgroup()
    {
        return $this->belongsTo(CG::class, 'cellgroup_id');
    }

}