<?php

namespace App\Models\Events\BibleReading;

use Illuminate\Database\Eloquent\Model;
use App\Models\Events\BibleReading\CheckInChapter;

class Chapter extends Model
{
    protected $table = 'e03_chapters';

    // REL
    public function checkInChapter()
    {
        return $this->hasMany(CheckInChapter::class);
    }

}