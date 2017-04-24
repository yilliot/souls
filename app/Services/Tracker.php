<?php

namespace App\Services;

use App\Models\UserTrack;
use App\Models\User;

class Tracker
{
    public function newUserTrack($userAgent = null)
    {
        $userTrack = new UserTrack();
        $userTrack->user_agent = $userAgent;
        $userTrack->save();
        return [
            'success' => true,
            'data' => [
                'id' => $userTrack->id
            ]
        ];
    }
}