<?php

namespace App\Models\Events\BibleReading;

use Illuminate\Database\Eloquent\Model;
use App\Models\Events\BibleReading\CheckIn;
use App\Models\Events\BibleReading\Chapter;
use App\Models\Events\BibleReading\Comment;

class CheckInChapter extends Model
{
    protected $table = 'e03_check_in_chapters';

    // REL
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function checkIn()
    {
        return $this->belongsTo(CheckIn::class);
    }

}