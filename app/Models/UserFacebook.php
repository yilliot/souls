<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFacebook extends Model
{
    protected $table = 'users_facebook';

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
