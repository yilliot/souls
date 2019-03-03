<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Soul;
use App\Models\Cg;

class CgController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->only(['sortBy', 'order']);
        $filter = array_default($filter, [
            'sortBy' => 'id',
            'order' => 'asc'
        ]);

        $cgs = Cg::with('type', 'venue', 'speaker')
            ->orderBy($filter['sortBy'], $filter['order'])
            ->paginate();

        return view('admin.cg.index', compact('cgs', 'filter'));
    }

    public function getCreateCgForm()
    {
        return view('admin.cg.create_cg_form');
    }

    public function postCreateCgForm(Request $request)
    {
        $cg = new Cg;
        $cg->updated_at = \Carbon\Carbon::now();
        $cg->created_by = \Auth::user()->id;

        $cg->title = $request->title;

        if ($request->has('end_date'))
            $cg->end_at = \Carbon\Carbon::parse($request->end_date . ' ' . $request->end_time);
        if ($request->has('type'))
            $cg->type_id = $request->type;
        if ($request->has('speaker'))
            $cg->speaker_id = $request->speaker;
        if ($request->has('venue'))
            $cg->venue_id = $request->venue;
        if ($request->has('is_church_wide'))
            $cg->is_church_wide = $request->is_church_wide;
        if ($request->has('cg_id'))
            $cg->cg_id = $request->cg_id;

        $cg->forecast_size = 0;
        $cg->attendance_size = 0;
        $cg->save();

        return back()->with('success', 'success')->with('message', 'created!');
    }

    public function show($id)
    {
        $cg = Cg::find($id);
        return view('admin.cg.show', compact('cg'));
    }

    public function getEditCgForm($id)
    {
        $cg = Cg::find($id);
        return view('admin.cg.edit_cg_form', compact('cg'));
    }

    public function postEditCgForm(Request $request, $id)
    {
        $cg = Cg::find($id);
        $cg->start_at = \Carbon\Carbon::parse($request->start_date . ' ' . $request->start_time);
        $cg->created_at = \Carbon\Carbon::now();
        $cg->updated_at = \Carbon\Carbon::now();
        $cg->created_by = \Auth::user()->id;

        $cg->title = $request->title;

        if ($request->has('end_date'))
            $cg->end_at = \Carbon\Carbon::parse($request->end_date . ' ' . $request->end_time);
        if ($request->has('type'))
            $cg->type_id = $request->type;
        if ($request->has('speaker'))
            $cg->speaker_id = $request->speaker;
        if ($request->has('venue'))
            $cg->venue_id = $request->venue;
        if ($request->has('is_church_wide'))
            $cg->is_church_wide = $request->is_church_wide;
        if ($request->has('cg_id'))
            $cg->cg_id = $request->cg_id;

        $cg->save();
        return back()->with('success', 'success')->with('message', 'updated!');
    }

    public function destroy($id)
    {
        $cg = Cg::find($id);
        $cg->delete();

        return back()->with('success', 'success')->with('message', 'deleted!');
    }
}
