<?php

namespace App\Http\Controllers\Event\Usher;

use App\Http\Controllers\Controller;
use App\Enums\Boolean;
use Illuminate\Http\Request;

class UsherController extends Controller
{
    public function home(Request $request)
    {
        return view('event.usher.home');
    }

    public function getnewcomer(Request $request)
    {

    $random = [
        ['id' => 1, 'name' => 'Joseph', 'phone' => '0127777777', 'inviter' => 'A', 'birthday' => 1999, 'christian' => Boolean::YES, 'FBID' => 123],
        ['id' => 2, 'name' => 'Elliot', 'phone' => '0126666666', 'inviter' => 'b', 'birthday' => 1988, 'christian' => Boolean::YES, 'FBID' => 456],
        ['id' => 3, 'name' => 'Davion', 'phone' => '0125555555', 'inviter' => 'c', 'birthday' => 1995, 'christian' => Boolean::YES, 'FBID' => 456],
        ['id' => 4, 'name' => 'Chloe', 'phone' => '0125555555', 'inviter' => 'd', 'birthday' => 1995, 'christian' => Boolean::YES, 'FBID' => 456],
        ['id' => 5, 'name' => 'Stephen', 'phone' => '0125555555', 'inviter' => 'e', 'birthday' => 1995, 'christian' => Boolean::YES, 'FBID' => 456],
    ];

    // dd($random);

        return view('event.usher.newcomer', compact('random'));
    }

    public function postnewcomer(Request $request)
    {
        return view('event.usher.home');
    }

    public function QRcode(Request $request)
    {
        return view('event.usher.QR');
    }
}