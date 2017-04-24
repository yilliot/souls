<?php

namespace App\Http\Controllers\Office;

use App\Models\UserSeller;
use Illuminate\Http\Request;

class SellersController extends OfficeController
{
    public function index(Request $request)
    {
        $filter = $request->only(['sortBy', 'order', 'approval_code']);
        $filter = array_default($filter, [
            'sortBy' => 'id',
            'order' => 'asc',
            'approval_code' => 0,
        ]);

        $query = Seller::orderBy($filter['sortBy'], $filter['order']);

        if ($filter['approval_code'] !== 'all') {
            $query->where('approval_code', $filter['approval_code']);
        }
        $jobs = $query->paginate();

        return view('office.jobs.index', compact('jobs', 'filter'));
    }

    public function get(Request $request)
    {
        $job = Seller::find($request->id);
        return view('office.jobs.get', compact('job'));
    }

    public function verify(Request $request)
    {
        $seller = UserSeller::find($request->id);
        return view('office.sellers.verify', compact('seller'));
    }

    public function postVerify(Request $request)
    {
        $seller = UserSeller::find($request->id);
        $seller->approval_code = $request->approval_code;
        $seller->legal_id = $request->exists('legal_id') ? $request->legal_id : $seller->legal_id;
        $seller->legal_full_name = $request->exists('legal_full_name') ? $request->legal_full_name : $seller->legal_full_name;
        $seller->legal_reject_code = $request->exists('legal_reject_code') ? $request->legal_reject_code : $seller->legal_reject_code;

        if ($request->approval_code == \App\Enums\ApprovalCodes::APPROVED) {
            $seller->legal_reject_code = null;
        }
        $seller->save();
        return back()->with('success', 'success')->with('message', 'Seller details has been updated');
    }
}