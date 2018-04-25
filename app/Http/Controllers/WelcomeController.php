<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Enums\Boolean;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{

    public function followuplist()
    {
        return [
            ['id' => 1, 'name' => 'Jordan'],
            ['id' => 2, 'name' => 'Lenny'],
            ['id' => 3, 'name' => 'Elliot'],
            ['id' => 4, 'name' => 'Eler'],
            ['id' => 5, 'name' => 'Jethro'],
        ];
    }

    public function newcomerlist()
    {
        return [
            ['id' => 1, 'name' => 'Joseph', 'phone' => '0127777777', 'inviter' => 'Wei Guo', 'birthday' => '1999/January/02', 'christian' => Boolean::YES, 'FBID' => 'joseph@ict.com', 'description' => 'My name is Joseph User shall provide valid bank account details which belongs to the User. If the bank account belongs to another person, User hereby warrants and agrees that User will be solely responsible for any issue arising from using bank account which belongs to another person to receive money from Timev. Meanwhile, the User will be solely responsible for any issues arising from providing incorrect bank account details.', 'assign' => '0'],
            ['id' => 2, 'name' => 'Elliot', 'phone' => '0126666666', 'inviter' => 'Wei Guo', 'birthday' => '1988/January/02', 'christian' => Boolean::YES, 'FBID' => 'elliot@ict.com', 'description' => 'My name is Elliot', 'assign' => '2'],
            ['id' => 3, 'name' => 'Davion', 'phone' => '0125555555', 'inviter' => 'Wei Guo', 'birthday' => '1995/January/02', 'christian' => Boolean::YES, 'FBID' => 'davion@ict.com', 'description' => 'My name is davion sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss', 'assign' => '2'],
            ['id' => 4, 'name' => 'Chloe', 'phone' => '0125555555', 'inviter' => 'Wei Guo', 'birthday' => '1995/January/03', 'christian' => Boolean::YES, 'FBID' => 'chloe@ict.com', 'description' => 'My name is Chloe', 'assign' => '0'],
            ['id' => 5, 'name' => 'Stephen', 'phone' => '0125555555', 'inviter' => 'Wei Guo', 'birthday' => '1995/January/02', 'christian' => Boolean::YES, 'FBID' => 'stephen@ict.com', 'description' => 'My name is Stephen', 'assign' => '1'],
        ];
    }

    public function home(Request $request)
    {
        return view('event.usher.home');
    }

    public function getnewcomer(Request $request)
    {

        $newcomerdetails = $this->newcomerlist();
        $followuplists = $this->followuplist();

        return view('newcomer', compact('newcomerdetails', 'followuplists'));
    }

    public function postnewcomer(Request $request)
    {
        return redirect()->back()->with('success', 'Success')->with('message', 'Assigned successfully');
    }

    public function QRcode(Request $request)
    {
        return view('QR');
    }

    public function getfollowup(Request $request)
    {

        $followuplists = $this->followuplist();
        $newcomerdetails = $this->newcomerlist();

        return view('followup', compact('newcomerdetails', 'followuplists'));
    }

    public function getfeedback(Request $request)
    {

        return view('feedback');
    }

    public function detail(Request $request)
    {

        return view('detail');
    }
}