<?php

namespace App\Models\Events\BibleReading;

use Illuminate\Database\Eloquent\Model;
use App\Models\Events\BibleReading\CheckInChapter;

class CheckIn extends Model
{
    protected $table = 'e03_check_ins';

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