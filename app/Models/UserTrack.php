<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTrack extends Model
{
    protected $table = 'users_track';

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
