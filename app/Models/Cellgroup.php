<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cellgroup extends Model
{
    protected $table = 'cellgroups';

    // REL
    public function leader()
    {
        return $this->belongsTo(Soul::class, 'leader');
    }

}