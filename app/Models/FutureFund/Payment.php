<?php

namespace App\Models\FutureFund;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'ff_payments';

    public function pledge() {
        return $this->belongsTo(Pledge::class);
    }
}