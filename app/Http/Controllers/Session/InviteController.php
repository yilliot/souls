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
        $sessions = Session::coming()->get();
        return view('session.index', compact('sessions'));
    }
    function member(Request $request)
    {
        $soul = Soul::where('nric', $request->input('nric'))->first();
        $invitations = Invitation::where('soul_id', $soul->id)->coming()->get();
        // dd($invitations->count());
        $sessionsPublic = Session::coming()->whereNotIn('id', $invitations->pluck('session_id'))->get();
        // dd($sessionsPublic->count());
        $invitations = $sessionsPublic->merge($invitations)->sortBy('start_at');
        return view('session.member', compact('invitations', 'soul'));
    }

    function postResponse(Request $request)
    {
        $soul = Soul::find($request->input('soul_id'));
        $session = Session::find($request->input('session_id'));
        Invitation::updateOrCreate(
            ['session_id' => $request->input('session_id'), 'soul_id' => $request->input('soul_id')],
            ['is_coming' => $request->input('action'), 'start_at' => $session->start_at]
        );
        return back()->with('success', 'Success')->with('message', 'Responded');
    }
}