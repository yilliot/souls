<?php

namespace App\Models\Welcome;

use Illuminate\Database\Eloquent\Model;
use App\Models\Soul;

class Followupper extends Model
{
    protected $table = 'welcome_followuppers';

    public function followupper()
    {
    	return $this->belongsTo(Soul::class, 'followupper_id');
    }
    public function followupComment()
    {
    	return $this->belongsTo(FollowupComment::class, 'followupper_id');
    }
}
