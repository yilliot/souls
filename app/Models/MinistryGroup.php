<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MinistryGroup extends Model
{
    protected $table = 'ministry_groups';

    // REL
    public function ministries()
    {
        return $this->belongsToMany(MinistryGroup::class, 'ministry_ministry_group', 'ministry_group_id', 'ministry_id');
    }
}