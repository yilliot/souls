<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\Guardian;

class VerifyEmailController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Guardian $guardian)
    {
        $this->middleware('guest');
        $this->guardian = $guardian;
    }

    public function verifyEmail($code)
    {
        $result = $this->guardian->verifyEmail($code);
        if ($result['success']) {
            $user = $result['user'];
            return view('auth.verify_email.verified', compact('user'));
        } else {
            abort(400, 'Invalid/Expired Verification Code');
            
        }
    }

}
