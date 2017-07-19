<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceVisitor extends Model
{
    protected $table = 'service_visitors';

    // GET
    public function __toString()
    {
        return $this->name;
    }

    // REL
    public function attendance()
    {
        return $this->belongsTo(ServiceAttendance::class, 'attendance_id');
    }
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