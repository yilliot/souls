<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobArea extends Model
{
    protected $table = 'job_areas';

    public $fillable = ['area_id'];

    public $timestamps = false;

    public function __toString()
    {
        return \App\Enums\Areas::getObj($this->area_id)->getName();
    }
}
