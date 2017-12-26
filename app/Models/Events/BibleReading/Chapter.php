<?php

namespace App\Models\Events\BibleReading;

use Illuminate\Database\Eloquent\Model;
use App\Models\Events\BibleReading\CheckInChapter;
use App\Models\Events\BibleReading\Comment;

class Chapter extends Model
{
    protected $table = 'e03_chapters';

    // REL
    public function checkInChapter()
    {
        return $this->hasMany(CheckInChapter::class);
    }

    public function comment()
    {
    	return $this->belongsToMany(Comment::class, 'e03_check_in_chapters', 'chapter_id', 'comment_id');
    }

}