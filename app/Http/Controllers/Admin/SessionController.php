<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Soul;
use App\Models\Session\Session;
use App\Models\Session\Invitation;

class SessionController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->only(['sortBy', 'order', 'onward']);
        $filter = array_default($filter, [
            'sortBy' => 'id',
            'order' => 'asc',
            'onward' => \Carbon\Carbon::now()->format('Y-m-d'),
        ]);

        $page_sessions = Session::with('type', 'venue', 'speaker')
            ->where('start_at', '>', $filter['onward'])
            ->orderBy('start_at', 'asc')
            ->paginate();
        $chunk_sessions = $page_sessions->groupBy(function($item, $key){
            return $item->start_at->format('Y F');
        });
        return view('admin.session.index', compact('chunk_sessions', 'page_sessions', 'filter'));
    }

    public function getInvitations(Request $request, $id)
    {
        $filter = $request->only(['sortBy', 'order', 'onward']);
        $filter = array_default($filter, [
            'sortBy' => 'id',
            'order' => 'asc',
            'onward' => \Carbon\Carbon::now()->format('Y-m-d'),
        ]);

        $session = Session::find($id);
        $invitations = Invitation::where('session_id', $id)->get();
        return view('admin.session.invitations', compact('session', 'invitations', 'filter'));
    }

    public function postInvitations(Request $request, $id)
    {
        $requestExploded = explode('.',$request->input('target'));

        $targetGroup = $requestExploded[0];
        $targetGroupId = $requestExploded[1];
        if ($targetGroup == 'team') {
            $soul_ids = Soul::where('cellgroup_id', $targetGroupId)->pluck('id');
        } else {
            $inputSouls = $request->input('souls');
            foreach ($inputSouls as $soulId) {
                Invitation::updateOrCreate(
                    ['session_id' => $id, 'soul_id' => $soulId],
                    ['cg_id' => $targetGroupId]
                );
            }
        }
        return back()->with('success', 'success')->with('message', 'Invited!');
    }

    public function getCreateSessionForm()
    {
        return view('admin.session.create_session_form');
    }

    public function postCreateSessionForm(Request $request)
    {
        $session = new Session;
        $session->start_at = \Carbon\Carbon::parse($request->start_date . ' ' . $request->start_time);
        $session->created_at = \Carbon\Carbon::now();
        $session->updated_at = \Carbon\Carbon::now();
        $session->created_by = \Auth::user()->id;

        $session->title = $request->title;

        if ($request->has('end_date'))
            $session->end_at = \Carbon\Carbon::parse($request->end_date . ' ' . $request->end_time);
        if ($request->has('type'))
            $session->type_id = $request->type;
        if ($request->has('speaker'))
            $session->speaker_id = $request->speaker;
        if ($request->has('venue'))
            $session->venue_id = $request->venue;

        $session->forecast_size = 0;
        $session->attendance_size = 0;
        $session->save();

        return redirect('admin/session')->with('success', 'success')->with('message', 'created!');
    }

    public function show($id)
    {
        $session = Session::find($id);

        $cellgroups = \App\Models\CG::with('members')->get();

        // REPORT
        // \DB::enableQueryLog();
        return view('admin.session.show', compact('session', 'cellgroups'));
    }

    public function getEditSessionForm($id)
    {
        $session = Session::find($id);
        return view('admin.session.edit_session_form', compact('session'));
    }

    public function postEditSessionForm(Request $request, $id)
    {
        $session = Session::find($id);
        $session->start_at = \Carbon\Carbon::parse($request->start_date . ' ' . $request->start_time);
        $session->created_at = \Carbon\Carbon::now();
        $session->updated_at = \Carbon\Carbon::now();

        $session->title = $request->title;

        if ($request->has('end_date'))
            $session->end_at = \Carbon\Carbon::parse($request->end_date . ' ' . $request->end_time);
        if ($request->has('type'))
            $session->type_id = $request->type;
        if ($request->has('speaker'))
            $session->speaker_id = $request->speaker;
        if ($request->has('venue'))
            $session->venue_id = $request->venue;

        $session->save();
        return back()->with('success', 'success')->with('message', 'updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $session = Session::find($id);
        $session->delete();

        return back()->with('success', 'success')->with('message', 'deleted!');
    }
}
