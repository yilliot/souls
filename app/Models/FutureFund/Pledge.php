<?php

namespace App\Models\FutureFund;

use Illuminate\Database\Eloquent\Model;
use App\Models\Soul;

class Pledge extends Model
{
    protected $table = 'ff_pledges';

    public function payments() {
        return $this->belongsTo(Payment::class);
    }
    public function soul() {
        return $this->belongsTo(Soul::class);
    }
}