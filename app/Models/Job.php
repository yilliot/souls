<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'jobs';

    // GET
    public function __toString()
    {
        return $this->title;
    }

    function getCategoryAttribute()
    {
        return \App\Enums\Categories::getObj($this->category_id)->getName();
    }
    function getCategoryGroupAttribute()
    {
        return \App\Enums\Categories::getObj($this->category_id)->getGroup()->getName();
    }
    function getApprovalCodeTranslateAttribute()
    {
        return \App\Enums\ApprovalCodes::getObj($this->approval_code)->getName();
    }
    function getIsAcceptAppointmentTranslateAttribute()
    {
        return $this->is_accept_appointment ? 'Yes' : 'No';
    }
    function getIsFreezedTranslateAttribute()
    {
        return $this->is_freezed ? 'Yes' : 'No';
    }

    // REL
    function seller()
    {
        return $this->belongsTo(\App\Models\UserSeller::class);
    }
    function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'seller_id');
    }

    function jobAreaIds()
    {
        return $this->hasMany(\App\Models\JobArea::class);
    }

}
