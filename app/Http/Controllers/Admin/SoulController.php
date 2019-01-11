<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Soul;
use App\Models\Cellgroup;
use App\Http\Requests\NewSoulRequest;
use App\Http\Requests\UpdateSoulRequest;

class SoulController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->only(['sortBy', 'order', 'cellgroup_id', 'is_active']);
        $filter = array_default($filter, [
            'sortBy' => 'id',
            'order' => 'desc',
            'cellgroup_id' => 'all',
            'is_active' => 'all',
        ]);

        $souls = Soul::with('cellgroup')
            ->orderBy($filter['sortBy'], $filter['order']);

        if ($filter['cellgroup_id'] !== 'all') {
            $souls = $souls->where('cellgroup_id', $filter['cellgroup_id']);
        }
        if ($filter['is_active'] !== 'all') {
            $souls = $souls->where('is_active', $filter['is_active']);
        }

        $souls = $souls->paginate(150);
        $cellgroups = Cellgroup::get();
        return view('admin.soul.index', compact('souls', 'cellgroups', 'filter', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.soul.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewSoulRequest $request)
    {
        $soul = new Soul;
        $soul->cellgroup_id = $request->cellgroup;
        $soul->baptism_id = $request->baptism;
        $soul->baptism_serial = strtoupper($request->baptism_serial);
        $soul->is_active = $request->is_active;
        $soul->nric = strtoupper($request->nric);
        $soul->nric_fullname = strtoupper($request->nric_fullname);
        $soul->birthday = $request->birthday;
        $soul->nickname = $request->nickname;
        $soul->email = strtolower($request->email);
        $soul->contact = $request->contact;
        $soul->contact2 = $request->contact2;
        $soul->address1 = $request->address1;
        $soul->address2 = $request->address2;
        $soul->postal_code = $request->postal_code;
        $soul->save();

        return back()->with('success', 'success')->with('message', 'created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $soul = Soul::find($id);

        return view('admin.soul.show', compact('soul'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $soul = Soul::find($id);

        return view('admin.soul.edit', compact('soul'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSoulRequest $request, $id)
    {
        $soul = Soul::find($id);
        $soul->cellgroup_id = $request->cellgroup;
        $soul->baptism_id = $request->baptism;
        $soul->baptism_serial = strtoupper($request->baptism_serial);
        $soul->is_active = $request->is_active;
        $soul->nric = strtoupper($request->nric);
        $soul->nric_fullname = strtoupper($request->nric_fullname);
        $soul->birthday = $request->birthday;
        $soul->nickname = $request->nickname;
        $soul->email = strtolower($request->email);
        $soul->contact = $request->contact;
        $soul->contact2 = $request->contact2;
        $soul->address1 = $request->address1;
        $soul->address2 = $request->address2;
        $soul->postal_code = $request->postal_code;
        $soul->save();

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
        $soul = Soul::find($id);
        $soul->delete();

        return back()->with('success', 'success')->with('message', 'deleted!');
    }
}
