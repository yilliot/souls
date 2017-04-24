<?php

namespace App\Http\Controllers\Office;

use App\Models\Job;
use App\Models\JobRejectCode;
use Illuminate\Http\Request;

class JobsController extends OfficeController
{
    public function index(Request $request)
    {
        $filter = $request->only(['sortBy', 'order', 'approval_code']);
        $filter = array_default($filter, [
            'sortBy' => 'id',
            'order' => 'asc',
            'approval_code' => 0,
        ]);

        $query = Job::orderBy($filter['sortBy'], $filter['order']);

        if ($filter['approval_code'] !== 'all') {
            $query->where('approval_code', $filter['approval_code']);
        }
        $jobs = $query->paginate();

        return view('office.jobs.index', compact('jobs', 'filter'));
    }

    public function get(Request $request)
    {
        $job = Job::find($request->id);
        return view('office.jobs.get', compact('job'));
    }

    public function reject(Request $request)
    {
        $job = Job::find($request->id);
        $codes = JobRejectCode::where('job_id', $request->id)
            ->get()
            ->pluck('code', 'field');
        return view('office.jobs.reject', compact('job', 'codes'));
    }

    public function postReject(Request $request)
    {
        JobRejectCode::where('job_id', $request->id)->delete();
        $count = 0;
        foreach ([
                'category', 'title', 'description', 'amount', 'duration',
                'photo1_path',
                'photo2_path',
                'photo3_path',
                'photo4_path',
            ] as $field) {
            if ($request->get($field)['reject_code'] !== 'null') {
                $jrc = new JobRejectCode();
                $jrc->job_id = $request->id;
                $jrc->field = $field;
                $jrc->code = $request->get($field)['reject_code'];
                $jrc->save();
                $count++;
            }
        }

        $areas = collect($request->area)->filter(function($value){ return $value !== 'null';});
        foreach ($areas as $area => $code) {

            $jrc = new JobRejectCode();
            $jrc->job_id = $request->id;
            $jrc->field = 'area.'.$area;
            $jrc->code = $code;
            $jrc->save();
            $count++;
        }

        if ($count) {
            $job = Job::find($request->id);
            $job->approval_code = \App\Enums\ApprovalCodes::REJECTED;
            $job->save();
            return back()->with('success', 'success')->with('message', $count . ' fields have been rejected.');
        }

        return back()->with('info', 'nothing happened')->with('message', 'nothing has been rejected');

    }
    public function postApprove(Request $request)
    {
        $job = Job::find($request->id);
        $job->approval_code = \App\Enums\ApprovalCodes::APPROVED;
        $job->save();
        return back()->with('success', 'success')->with('message', 'Service has been approved.');
    }
}