<?php

namespace App\Models\Session;

use Illuminate\Database\Eloquent\Model;
use App\Models\CG;
use App\Models\Soul;

class SessionVisitor extends Model
{
    protected $table = 'session_visitors';

    public function __toString()
    {
        return $this->name;
    }

    // REL
    public function attendance()
    {
        return $this->belongsTo(SessionAttendance::class, 'attendance_id');
    }
    public function cg()
    {
        return $this->belongsTo(CG::class, 'cellgroup_id');
    }
    public function soul()
    {
        return $this->belongsTo(Soul::class, 'soul_id');
    }
    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }

}