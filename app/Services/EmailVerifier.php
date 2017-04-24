<?php

namespace App\Services;

use App\Models\User;
use App\Models\EmailVerification;
use Illuminate\Support\Facades\Mail;

class EmailVerifier
{
    public function newEmailVerification(User $user)
    {
        EmailVerification::where('user_id', $user->id)->delete();
        $emailVerification = new EmailVerification();
        $emailVerification->user_id = $user->id;
        $emailVerification->generate();
        $emailVerification->save();

        $user->notify(new \App\Notifications\EmailNeedVerify($user));
    }
}