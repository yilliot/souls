<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->only(['sortBy', 'order', 'onward']);
        $filter = array_default($filter, [
            'sortBy' => 'id',
            'order' => 'asc',
            'onward' => \Carbon\Carbon::now()->format('Y-m-d'),
        ]);

        $page_services = Service::with('type', 'venue', 'speaker')
            ->where('at', '>', $filter['onward'])
            ->orderBy('at', 'asc')
            ->paginate(6);
        $chunk_services = $page_services->groupBy(function($item, $key){
            return $item->at->format('Y F');
        });
        return view('admin.service.index', compact('chunk_services', 'page_services', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $service = new Service;
        $service->at = $request->at;
        $service->topic = $request->topic;
        $service->type_id = $request->type;
        $service->speaker_id = $request->speaker;
        $service->venue_id = $request->venue;
        $service->forecast_size = 0;
        $service->attendance_size = 0;
        $service->save();

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
        $service = Service::find($id);

        $cellgroups = \App\Models\Cellgroup::all();

        // REPORT
        // \DB::enableQueryLog();
        $report = \DB::table('service_attendances')
            ->select(
                \DB::raw('IFNULL(SUM(is_attended), 0) as attended, COUNT(id) as forecast, cellgroup_id')
            )
            ->where('service_id', $id)
            ->groupBy('cellgroup_id')
            ->get()
            ->keyBy('cellgroup_id');
        // dd(\DB::getQueryLog());

        return view('admin.service.show', compact('service', 'cellgroups', 'report'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::find($id);
        return view('admin.service.edit', compact('service'));
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
        $service = Service::find($id);
        $service->at = $request->at;
        $service->topic = $request->topic;
        $service->type_id = $request->type;
        $service->speaker_id = $request->speaker;
        $service->venue_id = $request->venue;
        $service->save();

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
        $service = Service::find($id);
        $service->delete();

        return back()->with('success', 'success')->with('message', 'deleted!');
    }
}
