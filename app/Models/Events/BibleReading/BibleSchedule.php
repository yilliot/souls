<?php

namespace App\Models\Events\BibleReading;

use Illuminate\Database\Eloquent\Model;

class BibleSchedule extends Model
{
    protected $table = 'e03_bible_schedules';
    public function getDayOfWeekAttribute()
    {
        $date = new \Carbon\Carbon($this->day);
        return $date->dayOfWeek;
    }
}
