<?php

namespace App\Models\FutureFund;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table = 'ff_sessions';

    public function pledges() {
        return $this->hasMany(Pledge::class);
    }
}