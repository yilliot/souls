<?php

namespace App\Models\Events;

use Illuminate\Database\Eloquent\Model;
use App\Models\Soul;
use App\Models\Cellgroup;

class JustBeginRecord extends Model
{
    protected $table = 'e01_just_begin_records';

    // REL
    public function soul()
    {
        return $this->belongsTo(Soul::class, 'soul_id');
    }
    public function cellgroup()
    {
        return $this->belongsTo(Cellgroup::class, 'cellgroup_id');
    }

}