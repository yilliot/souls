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
        $group->name = $request->input('name');
        $group->leader_id = $request->input('leader_id');
        $group->colead1_id = $request->input('colead1_id');
        $group->colead2_id = $request->input('colead2_id');
        $group->is_active = $request->input('is_active');
        $group->save();

        return redirect('/admin/group')->with('success', 'success')->with('message', 'created!');
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
        $group->name = $request->input('name');
        $group->leader_id = $request->input('leader_id');
        $group->colead1_id = $request->input('colead1_id');
        $group->colead2_id = $request->input('colead2_id');
        $group->is_active = $request->input('is_active');
        $group->updated_at = \Carbon\Carbon::now();
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
