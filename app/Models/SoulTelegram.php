<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoulTelegram extends Model
{
    protected $table = 'soul_telegrams';

    public function __toString()
    {
        return $this->secret_code;
    }

    // REL
    public function soul()
    {
        return $this->belongsTo(Soul::class, 'soul_id');
    }
}