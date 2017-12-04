<?php

namespace App\Models\BibleReading;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cellgroup;
use App\Models\BibleReading\CheckIn;
use App\Models\BibleReading\Chapter;
use App\Models\BibleReading\Comment;

class CheckInChapter extends Model
{
    protected $table = 'chapters';

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