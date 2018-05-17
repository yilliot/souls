<?php

namespace App\Models\Welcome;

use Illuminate\Database\Eloquent\Model;
use App\Models\Soul;


class ChatRecord extends Model
{
    protected $table = 'welcome_chat_records';

    public function newComer()
    {
    	return $this->belongsTo(Soul::class, 'nc_id');
    }

     public function accompanion()
    {
    	return $this->belongsTo(Soul::class, 'accompanion_id');
    }

}
