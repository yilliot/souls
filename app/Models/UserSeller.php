<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSeller extends Model
{
    protected $table = 'users_seller';

    // GET
    public function __toString()
    {
        return (string) $this->legal_full_name;
    }
    function getLegalIdUrlAttribute()
    {
        return config('app.url') . '/files/' . $this->legal_id_path;
    }
    function getApprovalCodeTranslateAttribute()
    {
        return \App\Enums\ApprovalCodes::getObj($this->approval_code)->getName();
    }
    function getLegalRejectCodeTranslateAttribute()
    {
        return \App\Enums\LegalRejectCodes::getObj($this->legal_reject_code)->getName();
    }

    // REL
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'id');
    }
}
