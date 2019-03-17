<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Soul;
use App\Models\Group;

class GroupController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->only(['sortBy', 'order', 'is_active']);
        $filter = array_default($filter, [
            'sortBy' => 'id',
            'order' => 'asc',
            'is_active' => true,
        ]);

        $groups = Group::with([]);

        if ($filter['is_active'] !== 'all') {
            $groups = $groups->where('is_active', $filter['is_active']);
        }

        $groups = $groups->orderBy($filter['sortBy'], $filter['order'])
            ->paginate();

        return view('admin.group.index', compact('groups', 'filter'));
    }

    public function getCreateGroupForm()
    {
        return view('admin.group.create');
    }

    public function postCreateGroupForm(Request $request)
    {
        $group = new Group;
        $group->updated_at = \Carbon\Carbon::now();
        $group->created_by = \Auth::user()->id;

        $group->title = $request->title;

        if ($request->has('end_date'))
            $group->end_at = \Carbon\Carbon::parse($request->end_date . ' ' . $request->end_time);
        if ($request->has('type'))
            $group->type_id = $request->type;
        if ($request->has('speaker'))
            $group->speaker_id = $request->speaker;
        if ($request->has('venue'))
            $group->venue_id = $request->venue;
        if ($request->has('is_church_wide'))
            $group->is_church_wide = $request->is_church_wide;
        if ($request->has('group_id'))
            $group->group_id = $request->group_id;

        $group->forecast_size = 0;
        $group->attendance_size = 0;
        $group->save();

        return back()->with('success', 'success')->with('message', 'created!');
    }

    public function show($id)
    {
        $group = Group::find($id);
        return view('admin.group.show', compact('group'));
    }

    public function getEditGroupForm($id)
    {
        $group = Group::find($id);
        return view('admin.group.edit', compact('group'));
    }

    public function postEditGroupForm(Request $request, $id)
    {
        $group = Group::find($id);
        $group->start_at = \Carbon\Carbon::parse($request->start_date . ' ' . $request->start_time);
        $group->created_at = \Carbon\Carbon::now();
        $group->updated_at = \Carbon\Carbon::now();
        $group->created_by = \Auth::user()->id;

        $group->title = $request->title;

        if ($request->has('end_date'))
            $group->end_at = \Carbon\Carbon::parse($request->end_date . ' ' . $request->end_time);
        if ($request->has('type'))
            $group->type_id = $request->type;
        if ($request->has('speaker'))
            $group->speaker_id = $request->speaker;
        if ($request->has('venue'))
            $group->venue_id = $request->venue;
        if ($request->has('is_church_wide'))
            $group->is_church_wide = $request->is_church_wide;
        if ($request->has('group_id'))
            $group->group_id = $request->group_id;

        $group->save();
        return back()->with('success', 'success')->with('message', 'updated!');
    }

    public function destroy($id)
    {
        $group = Group::find($id);
        $group->delete();

        return back()->with('success', 'success')->with('message', 'deleted!');
    }
}
