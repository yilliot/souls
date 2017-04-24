<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhoneVerification extends Model
{
    protected $table = 'phone_verifications';

    public function generate()
    {
        $this->code = rand(1000, 9999);
    }
}
