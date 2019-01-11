<?php

namespace App\Models\FutureFund;

use Illuminate\Database\Eloquent\Model;
use App\Models\Soul;

class Pledge extends Model
{
    protected $table = 'ff_pledges';

    public function payments() {
        return $this->hasMany(Payment::class);
    }
    public function cleared_payments() {
        return $this->payments()->where('is_cleared', 1);
    }
    public function soul() {
        return $this->belongsTo(Soul::class);
    }
    public function session() {
        return $this->belongsTo(Session::class);
    }
}