<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Soul extends Model
{
    protected $table = 'souls';

    // REL
    public function ministries()
    {
        return $this->belongsToMany(Ministry::class, 'ministry_souls', 'soul_id', 'ministry_id');
    }

}