<?php

namespace App\Models\Session;

use Illuminate\Database\Eloquent\Model;
use App\Models\Soul;

class Invitation extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
        'start_at',
        'end_at',
    ];

    protected $fillable = ['session_id', 'cg_id', 'soul_id', 'is_coming', 'is_attended', 'start_at'];

    protected $table = 'session_invitations';

    public function soul()
    {
        return $this->belongsTo(Soul::class, 'soul_id');
    }
    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }
    // SCOPE
    public function scopeComing()
    {
        return $this->where('start_at', '>=' , date("Y-m-d"));
    }

}