<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Soul;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CompleteSoulController extends Controller
{

    public function getCompleteSoulForm(Request $request)
    {
        if (\Auth::guest()) {
            return redirect('/auth/login');
        }
        $nric = $request->input('nric');
        return view('auth.complete_soul_form', compact('nric'));
    }

    protected function postCompleteSoulForm(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users,email|max:255',
            'nric' => ['required',
                'max:255',
                'unique:souls,nric',
                'regex:/^(\d{6}-\d{2}-\d{4}|[A-PR-WY]\w{6,10})$/',
            ],
            'nric_fullname' => 'required|max:255',
            'nickname' => 'required|max:255',
            'contact' => 'required|between:10,11',
            'address1' => 'required|max:255',
            'address2' => 'required|max:255',
            'birthday' => 'required|date',
            'postal_code' => 'required|digits_between:5,8',
            'cellgroup_id' => 'required|exists:cellgroups,id',
        ]);

        $soul = new Soul;
        $soul->nric = $request->session()->pull('nric');
        $soul->nric_fullname = $request->input('nric_fullname');
        $soul->email = $request->input('email');
        $soul->nickname = $request->input('nickname');
        $soul->contact = $request->input('contact');
        $soul->address1 = $request->input('address1');
        $soul->address2 = $request->input('address2');
        $soul->postal_code = $request->input('postal_code');
        $soul->cellgroup_id = $request->input('cellgroup_id');
        $soul->birthday = $request->input('birthday');
        $soul->save();

        $user = \Auth::user();
        $user->soul_id = $soul->id;
        $user->save();


        return redirect()->intended('/');
    }
}
