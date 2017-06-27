<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    protected $table = 'service_types';

    // REL
    public function services()
    {
        return $this->hasMany(Service::class, 'type_id');
    }
}