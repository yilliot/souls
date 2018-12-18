<?php

namespace App\Models\FutureFund;

use Illuminate\Database\Eloquent\Model;

class Pledge extends Model
{
    protected $table = 'ff_pledges';

    public function payments() {
        return $this->belongsTo(Payment::class);
    }
}