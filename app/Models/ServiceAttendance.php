<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceAttendance extends Model
{
    protected $table = 'service_attendances';

    public function cellgroup()
    {
        return $this->belongsTo(Cellgroup::class, 'cellgroup_id');
    }
    public function soul()
    {
        return $this->belongsTo(Soul::class, 'soul_id');
    }
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

}