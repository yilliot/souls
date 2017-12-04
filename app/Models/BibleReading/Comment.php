<?php

namespace App\Models\BibleReading;

use Illuminate\Database\Eloquent\Model;
use App\Models\BibleReading\CheckInChapter;

class Comment extends Model
{
    protected $table = 'comments';

    // REL
    public function checkInChapter()
    {
        return $this->hasMany(CheckInChapter::class);
    }

}