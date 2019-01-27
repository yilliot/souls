<?php

namespace App\Models\Session;

use Illuminate\Database\Eloquent\Model;
use App\Models\CG;

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
        return $this->title;
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
        return $this->belongsTo(CG::class, 'cg_id');
    }

    // SCOPE
    public function scopeComing()
    {
        return $this->where('start_at', '>=' , date("Y-m-d"));
    }

    public function scopeChurchWide()
    {
        return $this->where('is_church_wide', true);
    }

}