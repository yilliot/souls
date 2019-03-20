<?php

namespace App\Models\Session;

use Illuminate\Database\Eloquent\Model;
use App\Models\Group;

class Session extends Model
{
    protected $table = 'sessions';
    protected $dates = [
        'created_at',
        'updated_at',
        'start_at',
        'end_at',
    ];

    public function __toString()
    {
        if ($this->title)
            return $this->title;
        return '';
    }

    // SET
    public function cacheAttendance()
    {
        $this->forecast_size = $this->forecast_attendances()->count();
        $this->attendance_size = $this->forecast_attendances()
            ->where('is_attended', 1)->count();
        return $this;
    }

    // REL
    public function forecast_attendances()
    {
        return $this->belongsToMany(Soul::class, 'session_attendances', 'session_id', 'soul_id');
    }

    public function venue()
    {
        return $this->belongsTo(SessionVenue::class, 'venue_id');
    }
    public function speaker()
    {
        return $this->belongsTo(SessionSpeaker::class, 'speaker_id');
    }
    public function type()
    {
        return $this->belongsTo(SessionType::class, 'type_id');
    }
    public function cg()
    {
        return $this->belongsTo(Group::class, 'cg_id');
    }

    // SCOPE
    public function scopeComing()
    {
        return $this->where('start_at', '>=' , date("Y-m-d"));
    }

}