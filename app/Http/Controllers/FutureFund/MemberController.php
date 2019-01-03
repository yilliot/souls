<?php

namespace App\Http\Controllers\FutureFund;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FutureFund\Session;
use App\Models\FutureFund\Pledge;
use App\Models\FutureFund\Payment;

class MemberController extends Controller
{
    function index(Request $request, $ff_code)
    {
        $session = Session::where('code', $ff_code)->first();

        if (\Auth::user()) {
            $pledge = Pledge::where('ff_code_id', $session->id)
                ->where('soul_id', \Auth::user()->soul->id)
                ->first();
            if ($pledge) {
                return redirect('/ff/' . $ff_code . '/' . $pledge->code);
             } 
        }

        // SESSION TOTAL
        $pledges = Pledge::where('is_banned', false)
            ->where('ff_code_id', $session->id)
            ->get();
        $session_total = $pledges->sum('amount');
        $pledgeIds = $pledges->pluck('id');

        // SESSION COLLECTED
        $session_collected = Payment::where('is_cleared', true)
            ->whereIn('ff_pledge_id', $pledgeIds)
            ->sum('amount');

        return view('future_fund.member.index', compact('session', 'session_collected', 'session_total'));
    }

    function show(Request $request, $ff_code, $pledge_code)
    {
        $pledge = Pledge::where('code', $pledge_code)->first();

        // pledge has secured with user account, required login
        if ($pledge->soul && $pledge->soul->user) {
            if (\Auth::guest()) {
                return redirect('/auth/login')->intended();
            } else {
                if (\Auth::user()->id !== $pledge->soul->user->id) {
                    dd('invalid access');
                }
            }
        }

        $session = Session::where('code', $ff_code)->first();

        // SESSION TOTAL
        $pledges = Pledge::where('is_banned', false)
            ->where('ff_code_id', $session->id)
            ->get();
        $session_total = $pledges->sum('amount');
        $pledgeIds = $pledges->pluck('id');

        // SESSION COLLECTED
        $session_collected = Payment::where('is_cleared', true)
            ->whereIn('ff_pledge_id', $pledgeIds)
            ->sum('amount');

        // PLEDGE TOTAL
        $pledge_total = $pledge->amount;


        // PLEDGE COLLECTED LIST
        $payments = Payment::where('ff_pledge_id', $pledge->id)
            ->get();

        $collected_payments = Payment::where('ff_pledge_id', $pledge->id)
            ->where('is_cleared', true)
            ->get();

        // PLEDGE COLLECTED
        $pledge_collected = $collected_payments->sum('amount');

        return view('future_fund.member.show', compact('session', 'session_collected', 'session_total', 'pledge_collected', 'pledge_total', 'pledge', 'payments', 'ff_code', 'pledge_code'));
    }

    function getPaymentForm(Request $request, $ff_code, $pledge_code)
    {
        $session = Session::where('code', $ff_code)->first();
        $pledge = Pledge::where('code', $pledge_code)->first();

        $collected_sum = Payment::where('ff_pledge_id', $pledge->id)
            ->where('is_cancelled', false)
            ->sum('amount');

        return view('future_fund.member.payment_form', compact('pledge', 'amount', 'collected_sum', 'ff_code', 'pledge_code'));
    }

    function postPaymentForm(Request $request, $ff_code, $pledge_code)
    {
        $this->validate($request, [
            'amount' => 'required|regex:/^\d*(\.\d{2})?$/',
        ]);

        $pledge = Pledge::where('code', $pledge_code)->first();

        $payment = new Payment;
        $payment->ff_pledge_id = $pledge->id;
        $payment->amount = $request->input('amount');
        $payment->remarks = $request->input('remarks');
        $payment->save();

        return redirect('/ff/'.$ff_code.'/'.$pledge_code);
    }
}