<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Soul;
use App\Models\User;

class RedirectController extends Controller
{
    public function getNric(Request $request)
    {
        $redirect_url = $request->input('redirect_url');
        return view('auth.redirect_nric', compact('redirect_url'));
    }
    public function postNric(Request $request)
    {
        $this->validate($request, [
            'nric' => [
                'exists:souls,nric',
            ],
        ]);
        $soul = Soul::where('nric', $request->input('nric'))->first();
        if ($soul) {
            return redirect($request->input('redirect_url').'?nric='.$soul->nric);
        }
        return redirect()->back()->with('error', 'Error!')->with('message', 'NRIC not found')->withInput();
    }
}
