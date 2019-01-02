<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Soul;
use App\Models\User;

class MergeUserController extends Controller
{
    public function getMergeNric()
    {
        return view('auth.merge_nric');
    }

    public function postMergeNric(Request $request)
    {
        // Validation rules
        $this->validate($request, [
            'nric' => [
                'required',
                'regex:/^(\d{6}-\d{2}-\d{4}|[A-PR-WY]\w{6,10})$/'],
        ]);

        // Search if soul exist for this nric
        $soul = Soul::where('nric' ,$request->input('nric'))->first();

        // if soul exist
        if ($soul) {

            // if login
            if (\Auth::user()) {
                $user = \Auth::user();
                $user->soul_id = $soul->id;
                $user->save();
                return redirect()->intended('/');
            }

            return redirect('/auth/signup/nric?nric=' . $request->input('nric'));


            // // new user merge with souls
            // $user = new User;
            // $user->email = $soul->email;
            // $user->password = '_FB_LOGIN_NO_PASSWORD_';
            // $user->first_name = $soul->nric_fullname;
            // $user->soul_id = $soul->id;
            // $user->facebook_id = session('facebook_id');
            // $user->save();
            // $request->session()->forget('facebook_id');
            // \Auth::login($user, true);
            // return redirect()->intended('/');
        } else {
            // redirect to details
            $request->session()->put('nric', $request->input('nric'));
            return redirect('/auth/signup?nric=' . $request->input('nric'));
        }
    }

}
