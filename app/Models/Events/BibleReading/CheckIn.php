<?php

namespace App\Models\Events\BibleReading;

use Illuminate\Database\Eloquent\Model;
use App\Models\Soul;
use App\Models\Events\BibleReading\CheckInChapter;
use App\Models\Events\BibleReading\Comment;

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

    public function comment()
    {
        return $this->belongsToMany(Comment::class, 'e03_check_in_chapters', 'check_in_id', 'comment_id');
}

}