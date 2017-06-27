<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceVenue extends Model
{
    protected $table = 'service_venues';

    // REL
    public function services()
    {
        return $this->hasMany(Service::class, 'venue_id');
    }
}