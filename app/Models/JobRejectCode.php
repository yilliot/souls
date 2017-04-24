<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobRejectCode extends Model
{
    protected $table = 'job_reject_codes';

    public $fillable = ['field', 'code'];

    public $timestamps = false;

    public function __toString()
    {
        return \App\Enums\JobRejectCodes::getObj($this->code)->getName();
    }
}
