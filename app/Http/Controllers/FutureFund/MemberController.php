<?php

namespace App\Http\Controllers\FutureFund;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FutureFund\Session;
use App\Models\FutureFund\Pledge;
use App\Models\FutureFund\Payment;
use App\Models\Soul;
use Illuminate\Support\Str;


class MemberController extends Controller
{

    function landing(Request $request, $ff_code)
    {
        $session = Session::where('code', $ff_code)->first();
        $nric = $request->input('nric');

        // auto add hyphen to IC format
        if (preg_match('/^\d{12}$/', $nric)) {
            $nric = substr($nric, 0, 6) . '-' . substr($nric, 6, 2) . '-' . substr($nric, 8, 4);
        }

        $nric = (preg_match('/^(\d{6}-\d{2}-\d{4}|[A-PR-WY]\w{6,10})$/', $nric)) ? $nric : null;

        if ($nric) {

            // Search if soul exist for this nric
            $soul = Soul::where('nric', $nric)->first();
            if ($soul && $soul->user) {
                // login
                $url = route('ff.makePledgeCode', ['ff_code' => $ff_code, 'soul' => $soul->id]);
                session(['after_login_url' => $url]);
                return redirect('/auth/login?email=' . $soul->user->email);
            }

            return view('future_fund.' . $ff_code . '.simple_soul', compact('soul','session', 'nric'));
        }

        return view('future_fund.'.$ff_code.'.landing', compact('session', 'nric'));
    }

    function postSimpleSoul(Request $request)
    {
        $this->validate($request, [
            'nric' => ['required',
                'max:255',
                'regex:/^(\d{6}-\d{2}-\d{4}|[A-PR-WY]\w{6,10})$/',
            ],
            'nric_fullname' => 'required|max:255',
            'nickname' => 'required|max:255',
            'contact' => 'required|between:10,12',
        ]);

        $soul = Soul::where('nric', $request->input('nric'))->first();

        if(!$soul) {
            $soul = new Soul;
            $soul->nric = $request->input('nric');
        }

        $soul->nric_fullname = $request->input('nric_fullname');
        $soul->nickname = $request->input('nickname');
        $soul->contact = $request->input('contact');
        $soul->save();

        return redirect()->route('ff.makePledgeCode', ['ff_code' => $request->input('ff_code'), 'soul' => $soul->id]);
    }

    function getMakePledgeCode(Request $request, $ff_code, Soul $soul)
    {
        $session = Session::where('code', $ff_code)->first();

        $pledge = Pledge::where('soul_id', $soul->id)
            ->where('session_id', $session->id)
            ->first();

        if(!$pledge) {
            $pledge = new Pledge;

            do{
                $pledge_code = Str::random(5);
            } while(Pledge::where('code', $pledge_code)->count());

            $pledge->session_id = $session->id;
            $pledge->soul_id = $soul->id;
            $pledge->name = $soul->nickname;
            $pledge->code = $pledge_code;
            $pledge->save();
        }

        $url = route('ff.show', ['ff_code' => $ff_code,'pledge_code' => $pledge->code]);

        // dd($url);
        // SMS URL to contact

        $message = $url . ' #IAMAGAMECHANGER';

        \Nexmo::message()->send([
            'to'   => $soul->contact,
            'from' => 'OASIS',
            'text' => $message,
        ]);

        return redirect()->to($url);
        
    }

    function reSignup(Request $request, $ff_code, $pledge_code)
    {
        $url_pre = '/ff/' . $ff_code . '/' . $pledge_code;
        $session = Session::where('code', $ff_code)->first();
        $pledge = Pledge::where('code', $pledge_code)->first();
        if (\Auth::user()) {
            $pledge->soul_id = \Auth::user()->soul->id;
            $pledge->save();
            return redirect($url_pre);
        } else {
            session()->put('after_login_url', $url_pre . '/signup');
            return redirect('/auth/merge/nric');
        }
    }

    function index(Request $request, $ff_code)
    {
        $session = Session::where('code', $ff_code)->first();

        if (\Auth::user()) {
            $pledge = Pledge::where('session_id', $session->id)
                ->where('soul_id', \Auth::user()->soul->id)
                ->first();
            if ($pledge) {
                return redirect('/ff/' . $ff_code . '/' . $pledge->code);
             } 
        }

        // SESSION TOTAL
        $pledges = Pledge::where('is_banned', false)
            ->where('session_id', $session->id)
            ->get();
        $session_total = $pledges->sum('amount');
        $pledgeIds = $pledges->pluck('id');

        // SESSION COLLECTED
        $session_collected = Payment::where('is_cleared', true)
            ->whereIn('pledge_id', $pledgeIds)
            ->sum('amount');

        return view('future_fund.'.$ff_code.'.member.index', compact('session', 'session_collected', 'session_total'));
    }

    function show(Request $request, $ff_code, $pledge_code)
    {
        $pledge = Pledge::where('code', $pledge_code)->first();

        // pledge has secured with user account, required login
        if ($pledge->soul && $pledge->soul->user) {
            if (\Auth::guest()) {
                \Auth::authenticate();
            } else {
                if (\Auth::user()->id !== $pledge->soul->user->id) {
                    abort(403, 'Unauthorized action.');
                }
            }
        }

        // if amount is 0
        if ($pledge->amount == 0) {
            return redirect('/ff/'.$ff_code.'/'.$pledge_code . '/amount');
        }

        $session = Session::where('code', $ff_code)->first();

        // SESSION TOTAL
        $pledges = Pledge::where('is_banned', false)
            ->where('session_id', $session->id)
            ->get();
        $session_total = $pledges->sum('amount');
        $pledgeIds = $pledges->pluck('id');

        // SESSION COLLECTED
        $session_collected = Payment::where('is_cleared', true)
            ->whereIn('pledge_id', $pledgeIds)
            ->sum('amount');

        // PLEDGE TOTAL
        $pledge_total = $pledge->amount;


        // PLEDGE COLLECTED LIST
        $payments = Payment::where('pledge_id', $pledge->id)
            ->get();

        $collected_payments = Payment::where('pledge_id', $pledge->id)
            ->where('is_cleared', true)
            ->get();

        // PLEDGE COLLECTED
        $pledge_collected = $collected_payments->sum('amount');

        return view('future_fund.'.$ff_code.'.member.show', compact('session', 'session_collected', 'session_total', 'pledge_collected', 'pledge_total', 'pledge', 'payments', 'ff_code', 'pledge_code'));
    }

    function getPaymentForm(Request $request, $ff_code, $pledge_code)
    {
        $session = Session::where('code', $ff_code)->first();
        $pledge = Pledge::where('code', $pledge_code)->first();

        $collected_sum = Payment::where('pledge_id', $pledge->id)
            ->where('is_cancelled', false)
            ->sum('amount');

        return view('future_fund.'.$ff_code.'.member.payment_form', compact('pledge', 'amount', 'collected_sum', 'ff_code', 'pledge_code'));
    }

    function postPaymentForm(Request $request, $ff_code, $pledge_code)
    {
        $this->validate($request, [
            'amount' => 'required|regex:/^\d*(\.\d{2})?$/',
        ]);

        $pledge = Pledge::where('code', $pledge_code)->first();

        $payment = new Payment;
        $payment->pledge_id = $pledge->id;
        $payment->amount = $request->input('amount');
        $payment->remarks = $request->input('remarks');
        $payment->save();

        return redirect('/ff/'.$ff_code.'/'.$pledge_code);
    }

    function getAmountForm(Request $request, $ff_code, $pledge_code)
    {
        $session = Session::where('code', $ff_code)->first();
        $pledge = Pledge::where('code', $pledge_code)->first();

        return view('future_fund.' . $ff_code . '.member.amount', compact('pledge', 'ff_code'));
    }

    function postAmountForm(Request $request, $ff_code, $pledge_code)
    {
        $this->validate($request, [
            'amount' => 'required|regex:/^\d*(\.\d{2})?$/',
        ]);

        $pledge = Pledge::where('code', $pledge_code)->first();
        $pledge->remarks = $pledge->remarks . PHP_EOL . 'update amount from ' . $pledge->amount . ' to ' . $request->input('amount');
        $pledge->amount = $request->input('amount');
        $pledge->save();


        return redirect('/ff/'.$ff_code.'/'.$pledge_code);
    }
}