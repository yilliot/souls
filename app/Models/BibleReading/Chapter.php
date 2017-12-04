<?php

namespace App\Models\BibleReading;

use Illuminate\Database\Eloquent\Model;
use App\Models\BibleReading\CheckInChapter;

class Chapter extends Model
{
    protected $table = 'chapters';

    // REL
    public function checkInChapter()
    {
        return $this->hasMany(CheckInChapter::class);
    }

}