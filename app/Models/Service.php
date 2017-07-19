<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';
    protected $dates = [
        'created_at',
        'updated_at',
        'at'
    ];

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
        return $this->belongsToMany(Soul::class, 'service_attendances', 'service_id', 'soul_id');
    }

    public function venue()
    {
        return $this->belongsTo(ServiceVenue::class, 'venue_id');
    }
    public function speaker()
    {
        return $this->belongsTo(ServiceSpeaker::class, 'speaker_id');
    }
    public function type()
    {
        return $this->belongsTo(ServiceType::class, 'type_id');
    }

}