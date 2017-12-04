<?php

namespace App\Models\BibleReading;

use Illuminate\Database\Eloquent\Model;
use App\Models\BibleReading\CheckInChapter;

class CheckIn extends Model
{
    protected $table = 'check_ins';

    // REL
    public function checkInChapter()
    {
        return $this->hasMany(CheckInChapter::class);
    }

    public function soul()
    {
        return $this->belongsTo(Soul::class, 'soul_id');
    }

}