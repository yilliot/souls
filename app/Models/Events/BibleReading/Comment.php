<?php

namespace App\Models\Events\BibleReading;

use Illuminate\Database\Eloquent\Model;
use App\Models\Events\BibleReading\CheckInChapter;
use App\Models\Events\BibleReading\Chapter;

class Comment extends Model
{
    protected $table = 'e03_comments';

    // REL
    public function checkInChapter()
    {
        return $this->hasMany(CheckInChapter::class);
    }

    public function chapter()
    {
    	return $this->belongsToMany(Chapter::class, 'e03_check_in_chapters', 'comment_id', 'chapter_id');
    }
    
    public function soul()
    {
        return $this->belongsTo(Soul::class, 'soul_id');
    }

}