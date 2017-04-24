<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EmailVerification extends Model
{
    protected $table = 'email_verifications';

    public function __toString()
    {
        return $this->code;
    }

    public function generate()
    {
        $this->code = Str::random(60);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
