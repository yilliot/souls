<?php

namespace App\Http\Controllers\Session;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Session\Session;
use App\Models\Session\Invitation;
use App\Models\Soul;

class InviteController extends Controller
{
    function index(Request $request)
    {
        $sessions = Session::coming()->churchWide()->get();
        return view('session.index', compact('sessions'));
    }
    function member(Request $request)
    {
        $soul = Soul::where('nric', $request->input('nric'))->first();
        $invitations = Invitation::where('soul_id', $soul->id)->get();
        $sessionsPublic = Session::coming()->churchWide()->get();
        $sessionsInvited = Session::whereIn('id', $invitations->pluck('session_id'))->get();
        $sessions = $sessionsPublic->merge($sessionsInvited)->sortBy('start_at');
        return view('session.member', compact('sessions', 'invitations', 'soul'));
    }

    function postResponse(Request $request)
    {
        $soul = Soul::find($request->input('soul_id'));
        Invitation::updateOrCreate(
            ['session_id' => $request->input('session_id'), 'soul_id' => $request->input('soul_id')],
            ['is_coming' => $request->input('action'), 'cg_id' => $soul->cellgroup_id]
        );
        return back()->with('success', 'Success')->with('message', 'Responded');
    }
}