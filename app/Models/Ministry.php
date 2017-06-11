<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ministry extends Model
{
    protected $table = 'ministries';

    // REL
    public function groups()
    {
        return $this->belongsToMany(MinistryGroup::class, 'ministry_ministry_group', 'ministry_id', 'ministry_group_id');
    }

    public function souls()
    {
        return $this->belongsToMany(MinistryGroup::class, 'ministry_ministry_group', 'ministry_id', 'ministry_group_id');
    }

}