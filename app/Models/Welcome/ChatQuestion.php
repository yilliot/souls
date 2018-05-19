<?php

namespace App\Models\Welcome;

use Illuminate\Database\Eloquent\Model;

class ChatQuestion extends Model
{
    protected $table = 'welcome_chat_questions';
    protected $casts = [
        'options' => 'array',
    ];
}