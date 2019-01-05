<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FutureFund\Session;
use App\Models\FutureFund\Pledge;
use App\Models\FutureFund\Payment;

class FutureFundController extends Controller
{
    public function paymentPendingIndex(Request $request, $id)
    {
        $payments = Payment::where('is_cleared', false)
            ->where('is_cancelled', false)
            ->get();

        return view('admin.ff.payment_pending_index', compact('payments', 'id'));
    }

    public function getPledge(Request $request, $pledge_id)
    {
        $filter = $request->only(['sortBy', 'order', 'is_cleared', 'is_cancelled']);
        $filter = array_default($filter, [
            'sortBy' => 'id',
            'order' => 'desc',
            'is_cleared' => 'all',
            'is_cancelled' => 'all',
        ]);

        $pledge = Pledge::with('payments')->find($pledge_id);
        $payments = Payment::where('pledge_id', $pledge_id)
            ->orderBy('created_at', 'asc')
            ->get();

        $collected_payments = Payment::where('pledge_id', $pledge->id)
            ->where('is_cleared', true)
            ->get();

        // PLEDGE COLLECTED
        $pledge_collected = $collected_payments->sum('amount');

        return view( 'admin.ff.payment_index', compact('pledge', 'payments', 'filter', 'pledge_collected'));
    }
    public function index(Request $request)
    {
        $filter = $request->only(['sortBy', 'order', 'is_active']);
        $filter = array_default($filter, [
            'sortBy' => 'id',
            'order' => 'desc',
            'is_active' => 'all',
        ]);

        $ffs = Session::where('is_active', true)
            ->orderBy('created_at', 'asc')
            ->paginate();
        return view('admin.ff.index', compact('ffs', 'filter'));
    }

    public function pledgeIndex(Request $request, $id)
    {
        $filter = $request->only(['sortBy', 'order', 'is_banned']);
        $filter = array_default($filter, [
            'sortBy' => 'id',
            'order' => 'desc',
            'is_banned' => 'all',
        ]);

        $pledges = Pledge::where('session_id', $id)
            ->where('is_banned', false)
            ->orderBy('created_at', 'asc')
            ->paginate(100);
        return view('admin.ff.pledge_index', compact('pledges', 'filter', 'id'));
    }

    public function getUpdatePledgeForm(Request $request, $pledge_id)
    {
        $pledge = Pledge::find($pledge_id);
        return view('admin.ff.update_pledge_form', compact('pledge'));
    }
    public function postUpdatePledgeForm(Request $request, $pledge_id)
    {
        $pledge = Pledge::find($pledge_id);
        $pledge->name = $request->name;
        $pledge->amount = $request->amount;
        $pledge->is_banned = $request->is_banned;
        $pledge->save();

        return back()->with('success', 'success')->with('message', 'updated!');
    }
    public function getPledgeForm(Request $request, $id)
    {
        return view('admin.ff.create_pledge_form', compact('id'));
    }
    public function postPledgeForm(Request $request, $id)
    {

        $pledge = new Pledge;

        $pledge->session_id = $id;
        $pledge->name = $request->name;
        $pledge->amount = $request->amount;
        $pledge->is_banned = 0;
        $pledge->code = '-';
        $pledge->save();
        $pledge->code = $this->codes($pledge->id);
        $pledge->save();

        return back()->with('success', 'success')->with('message', 'created!');
    }
    public function getCreatePaymentForm(Request $request, $pledge_id)
    {
        $pledge = Pledge::find($pledge_id);
        return view('admin.ff.create_payment_form', compact('pledge'));
    }
    public function postCreatePaymentForm(Request $request, $pledge_id)
    {
        $pledge = Pledge::find($pledge_id);

        $payment = new Payment;


        $payment->pledge_id = $pledge_id;
        $payment->amount = $request->input('amount');
        $payment->is_cleared = $request->input('is_cleared');
        $payment->is_cancelled = $request->input('is_cancelled');
        $payment->remarks = $request->input('remarks');
        $payment->save();

        return redirect('/admin/ff/pledge/' . $pledge_id)->with('success', 'success')->with('message', 'created!');

    }
    public function getUpdatePaymentForm(Request $request, $payment_id)
    {
        $payment = Payment::find($payment_id);
        return view('admin.ff.update_payment_form', compact('payment'));
    }
    public function postUpdatePaymentForm(Request $request, $payment_id)
    {

        $payment = Payment::find($payment_id);

        $payment->amount = $request->input('amount');
        $payment->is_cleared = $request->input('is_cleared');
        $payment->is_cancelled = $request->input('is_cancelled');
        $payment->remarks = $request->input('remarks');
        $payment->save();

        return back()->with('success', 'success')->with('message', 'updated!');
    }

    public function codes($index)
    {
        return [
            'JSG7R',
            '88AXC',
            'G79GT',
            '62XFY',
            'FU4Y9',
            'FWVVE',
            'BK3MQ',
            'ZKDX5',
            'LJGG9',
            'AK623',
            'FKDV9',
            '52SJT',
            'ME2WG',
            'JF33W',
            'RNBVG',
            '2B38G',
            'HVZQH',
            '6EC8L',
            'SPMC7',
            'KT6SZ',
            'SUSLW',
            'XUZ3X',
            'A58RH',
            'SEB9S',
            'ZJQSV',
            'QM4RF',
            'SAS6F',
            'E5AMB',
            'N3U5A',
            'RPS46',
            'WVSZU',
            'MSJMR',
            'U76QR',
            '62CM7',
            'KKJUQ',
            'VC9ZC',
            '72FAF',
            'M4QCC',
            'GK3WR',
            '2LFGK',
            'LYVJC',
            '3Y68F',
            'BXWAC',
            'W3HHV',
            'JY8XD',
            'JTUHN',
            'SMVNT',
            'LP7WZ',
            'YRR7H',
            'ZXN7D',
            'E3GJ3',
            '8Q9JU',
            'FDWTR',
            'WNEPX',
            'NZU59',
            'ASJ83',
            'USFJA',
            '85FXX',
            'XEC2S',
            'BVRDV',
            '437UC',
            'WQLRV',
            'GFX93',
            '9Z4VS',
            '6BWML',
            'WYBBS',
            'FFVSU',
            'YNRXZ',
            '279EN',
            'PNP8N',
            '4KH45',
            'NXKWJ',
            'K57FY',
            '9JERU',
            'FG3WX',
            'ZUYGE',
            '665LU',
            'D5VJP',
            '2DX58',
            '2AL77',
            'YXH4E',
            'YJQGR',
            'C37HP',
            '5ATM8',
            '5H2G5',
            'VGXFC',
            '9N5Q2',
            'TS6A8',
            'NZ8R5',
            'S2UAW',
            '7HM6H',
            'G2UCB',
            'AGHJ5',
            'TJLK5',
            'V8YNK',
            'QDVXT',
            'SG7YM',
            'X44NH',
            '3SFED',
            '89R8M',
        ][$index];
    }
}
