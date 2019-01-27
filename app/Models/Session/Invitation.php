<?php

namespace App\Models\Session;

use Illuminate\Database\Eloquent\Model;
use App\Models\Soul;
use App\Models\CG;

class Invitation extends Model
{
    protected $fillable = ['session_id', 'cg_id', 'soul_id', 'is_coming', 'is_attended'];

    protected $table = 'session_invitations';

    public function invitor()
    {
        return $this->belongsTo(Soul::class, 'attendance_id');
    }
    public function cg()
    {
        return $this->belongsTo(CG::class, 'cg_id');
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