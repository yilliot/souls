<?php

namespace App\Http\Controllers\Admin\Leader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Soul;
use App\Models\Leader\ConnectInvitation;
use App\Models\Leader\Connect;
use App\Models\Leader\Follower;

class FollowerController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->only(['sortBy', 'order', 'onward']);
        $filter = array_default($filter, [
            'sortBy' => 'id',
            'order' => 'asc',
        ]);

        $followers = Follower::with('follower')
            ->where('leader_id', \Auth::user()->soul_id)
            ->orderBy($filter['sortBy'], $filter['order'])
            ->get();

        return view('admin.leader.follower.index', compact('followers', 'filter'));
    }

    public function getAddFollowerForm()
    {
        $souls = Soul::with('leaders')
            ->where('id', '<>', \Auth::user()->soul_id)
            ->get();

        return view('admin.leader.follower.add_follower_form', compact('souls'));
    }

    public function postAddFollowerForm(Request $request)
    {
        \Auth::user()->soul->followers()->syncWithoutDetaching($request->input('follower_id'));

        return back()->with('success', 'success')->with('message', 'added!');
    }

    public function postRemoveFollower(Request $request)
    {
        \Auth::user()->soul->followers()->detach($request->input('follower_id'));

        return back()->with('success', 'success')->with('message', 'deleted!');
    }
}
