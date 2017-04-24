<?php

namespace App\Services;

use App\Models\UserTrack;
use App\Models\UserFacebook;
use App\Models\User;
use App\Models\EmailVerification;
use App\Models\PhoneVerification;
use JWTAuth;

class Guardian
{
    const FACEBOOK_PASSWORD = '_FB_LOGIN_NO_PASSWORD_';

    public function emailSignup($email, $password, $firstName, $lastName = null, $phone)
    {
        // phone existed
        $code = 1011;
        $success = false;
        $user = User::where('phone', $phone)->first();

        if (!$user) {
            // email signup ok
            $user = new User();
            $user->phone = $phone;
            $user->email = $email;
            $user->password = bcrypt($password);
            $user->first_name = $firstName;
            $user->last_name = $lastName;
            $user->is_fbauth_only = false;
            $user->save();
            $code = 1;
            $success = true;
        } else if ($user->is_fbauth_only) {
            // merge fb
            $user->email = $email;
            $user->password = bcrypt($password);
            $user->first_name = $firstName;
            $user->last_name = $lastName;
            $user->is_fbauth_only = false;
            $user->save();
            $code = 1;
            $success = true;
        }


        app(EmailVerifier::class)->newEmailVerification($user);

        return compact(['success', 'code', 'user']);
    }

    public function storeUserFacebook($socialiteFbUser)
    {
        $userFacebook = UserFacebook::where('facebook_id', $socialiteFbUser->id)->first();

        if (!$userFacebook) {
            $userFacebook = new UserFacebook();
            $userFacebook->facebook_id = $socialiteFbUser->id;
        }
        $userFacebook->token = $socialiteFbUser->token;
        $userFacebook->refresh_token = $socialiteFbUser->refreshToken;
        $userFacebook->expires_in = $socialiteFbUser->expiresIn;
        $userFacebook->name = $socialiteFbUser->name;
        $userFacebook->email = $socialiteFbUser->email;
        $userFacebook->verified = $socialiteFbUser->user['verified'];
        $userFacebook->avatar = $socialiteFbUser->avatar;
        $userFacebook->save();

        return $userFacebook;
    }

    public function createUserFromFacebook(UserFacebook $userFacebook, User $user)
    {
        $user->email = $userFacebook->facebook_id . '@fb.c';
        $user->password = self::FACEBOOK_PASSWORD;
        $user->first_name = $userFacebook->name;
        $user->last_name = '';
        $user->is_fbauth_only = true;

        $user->save();

        return $user;

    }

    public function verifyPhone($phone, $verification_code)
    {
        $phoneVerification = PhoneVerification::where('phone', $phone)->first();

        // phone failed to verify
        $code = \App\Enums\ResponseErrorCodes::PHONE_VERIFY_FAILED;
        $success = false;

        if (
            $phoneVerification && 
            $phoneVerification->code === $verification_code && 
            $phoneVerification->created_at->diffInMinutes() <= 10 // 10 minutes
            )
        {
            $phoneVerification->delete();

            $code = 1;
            $success = true;
        }
        return compact(['success', 'code']);
    }

    public function verifyEmail($code)
    {
        $emailVerification = EmailVerification::where('code', $code)->first();
        $user = null;

        // email failed to verify
        $success = false;

        if (
            $emailVerification && 
            $emailVerification->created_at->diffInDays() <= 3 // 10 minutes
            )
        {
            $success = true;
            $user = $emailVerification->user;
            $user->is_email_verified = true;
            $user->save();
            $emailVerification->delete();
        }
        return compact(['success', 'user']);
    }

    public function login($email, $password, $userTrackId = null)
    {
        $user = User::where(['email' => $email])->first();

        $success = false;

        if ($user->is_fbauth_only) {
            // facebook auth only
            $code = 1004;

        } else if (!$user) {
            // user not found
            $code = 1002;

        } else if (!\Hash::check($password, $user->password) || $password === self::FACEBOOK_PASSWORD) {
            // wrong password
            $code = 1003;

        } else if (\Hash::check($password, $user->password)) {

            $code = 1;
            $success = true;
            $data['token'] = JWTAuth::fromUser($user);

            // update user track
            if ($userTrackId) {
                $userTrack = UserTrack::find($userTrackId);
                $userTrack->user_id = $user->id;
                $userTrack->save();
            }
        }

        return compact(['success', 'code', 'data']);
    }
}