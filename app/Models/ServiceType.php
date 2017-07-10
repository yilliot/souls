<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    protected $table = 'service_types';

    // GET
    public function __tostring()
    {
        return $this->name;
    }

    // REL
    public function services()
    {
        return $this->hasMany(Service::class, 'type_id');
    }
}