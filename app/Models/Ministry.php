<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Ministry extends Model
{
    use NodeTrait;

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