<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceSpeaker extends Model
{
    protected $table = 'service_speakers';

    // REL
    public function services()
    {
        return $this->hasMany(Service::class, 'speaker_id');
    }
}