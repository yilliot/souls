<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Soul;
use App\Models\User;

class MergeUserController extends Controller
{
    public function getMergeNric(Request $request)
    {
        $nric = $request->input('nric');
        return view('auth.merge_nric', compact('nric'));
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

        // if had login
        if (\Auth::user()) {
            if ($soul) {
                $user = \Auth::user();
                $user->soul_id = $soul->id;
                $user->save();
                return redirect()->intended('/');
            } else {
                return redirect('/auth/complete_profile?nric=' . $request->input('nric'));
            }
        }
        // new signup
        return redirect('/auth/signup?nric=' . $request->input('nric'));
    }

}
