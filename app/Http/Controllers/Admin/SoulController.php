<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Soul;

class SoulController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->only(['sortBy', 'order', 'cellgroup']);
        $filter = array_default($filter, [
            'sortBy' => 'id',
            'order' => 'asc',
            'cellgroup' => 'all',
        ]);

        $souls = Soul::paginate();
        return view('admin.soul.index', compact('souls'));
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
    public function store(Request $request)
    {
        $soul = new Soul;
        $soul->cellgroup_id = $request->cellgroup;
        $soul->baptism_id = $request->baptism;
        $soul->baptism_serial = $request->baptism_serial;
        $soul->is_active = $request->is_active;
        $soul->nric = $request->nric;
        $soul->nric_fullname = $request->nric_fullname;
        $soul->birthday = $request->birthday;
        $soul->nickname = $request->nickname;
        $soul->email = $request->email;
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
    public function update(Request $request, $id)
    {
        $soul = new Soul;
        $soul->cellgroup_id = $request->cellgroup;
        $soul->baptism_id = $request->baptism;
        $soul->baptism_serial = $request->baptism_serial;
        $soul->is_active = $request->is_active;
        $soul->nric = $request->nric;
        $soul->nric_fullname = $request->nric_fullname;
        $soul->birthday = $request->birthday;
        $soul->nickname = $request->nickname;
        $soul->email = $request->email;
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
