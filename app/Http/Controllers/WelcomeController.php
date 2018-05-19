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
            ['id' => 1, 'nric' => '990602-01-5566', 'nric_fullname' => 'Joseph Chew Hou Ren', 'birthday' => '1999-06-02', 'email' => 'joseph@ict.com', 'contact' => '012-7777777', 'contact2' => '012-77777777', 'address' => 'No.61, Jalan Harmonium 35/1, Taman Desa Tebrau, 81100 Johor Bahru, Johor Darul Takzim, Malaysia.', 'address2' => 'No.61, Jalan Harmonium 35/1, Taman Desa Tebrau, 81100 Johor Bahru, Johor Darul Takzim, Malaysia.', 'postal_code' => '81100', 'new_comer' => Boolean::YES, 'nickname' => 'Joseph', 'assign' => 2],
            ['id' => 2, 'nric' => '880602-01-5566', 'nric_fullname' => 'Elliot Yap', 'birthday' => '1988-06-02', 'email' => 'elliot@ict.com', 'contact' => '012-7777777', 'contact2' => '012-77777777', 'address' => 'No.61, Jalan Harmonium 35/1, Taman Desa Tebrau, 81100 Johor Bahru, Johor Darul Takzim, Malaysia.', 'address2' => 'No.61, Jalan Harmonium 35/1, Taman Desa Tebrau, 81100 Johor Bahru, Johor Darul Takzim, Malaysia.', 'postal_code' => '81100', 'new_comer' => Boolean::YES, 'nickname' => 'Elliot', 'assign' => 1],
            ['id' => 3, 'nric' => '950602-01-5566', 'nric_fullname' => 'Davion Lee', 'birthday' => '1995-06-02', 'email' => 'davion@ict.com', 'contact' => '012-7777777', 'contact2' => '012-77777777', 'address' => 'No.61, Jalan Harmonium 35/1, Taman Desa Tebrau, 81100 Johor Bahru, Johor Darul Takzim, Malaysia.', 'address2' => 'No.61, Jalan Harmonium 35/1, Taman Desa Tebrau, 81100 Johor Bahru, Johor Darul Takzim, Malaysia.', 'postal_code' => '81100', 'new_comer' => Boolean::YES, 'nickname' => 'Davion', 'assign' => 2],
            ['id' => 4, 'nric' => '950602-01-5566', 'nric_fullname' => 'Chloe Goh', 'birthday' => '1995-06-02', 'email' => 'chloe@ict.com', 'contact' => '012-7777777', 'contact2' => '012-77777777', 'address' => 'No.61, Jalan Harmonium 35/1, Taman Desa Tebrau, 81100 Johor Bahru, Johor Darul Takzim, Malaysia.', 'address2' => 'No.61, Jalan Harmonium 35/1, Taman Desa Tebrau, 81100 Johor Bahru, Johor Darul Takzim, Malaysia.', 'postal_code' => '81100', 'new_comer' => Boolean::YES, 'nickname' => 'Chloe', 'assign' => 1],
            ['id' => 5, 'nric' => '950602-01-5566', 'nric_fullname' => 'Stephen Khooooo', 'birthday' => '1995-06-02', 'email' => 'chloe@ict.com', 'contact' => '012-7777777', 'contact2' => '012-77777777', 'address' => 'No.61, Jalan Harmonium 35/1, Taman Desa Tebrau, 81100 Johor Bahru, Johor Darul Takzim, Malaysia.', 'address2' => 'No.61, Jalan Harmonium 35/1, Taman Desa Tebrau, 81100 Johor Bahru, Johor Darul Takzim, Malaysia.', 'postal_code' => '81100', 'new_comer' => Boolean::YES, 'nickname' => 'Stephen', 'assign' => 2],
        ];
    }

    public function home(Request $request)
    {
        return view('welcome.home');
    }

    public function getnewcomer(Request $request)
    {

        $newcomerdetails = $this->newcomerlist();
        $followuplists = $this->followuplist();

        return view('welcome.newcomer', compact('newcomerdetails', 'followuplists'));
    }

    public function getnewcomerPublicProfile(Request $request)
    {

        $newcomerdetails = $this->newcomerlist();
        $followuplists = $this->followuplist();

        return view('welcome.newcomer.public_profile', compact('newcomerdetails', 'followuplists'));
    }

    public function getnewcomerAssignedPeople(Request $request)
    {

        $newcomerdetails = $this->newcomerlist();
        $followuplists = $this->followuplist();

        return view('welcome.newcomer.assigned_people', compact('newcomerdetails', 'followuplists'));
    }

    public function getfollowupProfileID(Request $request)
    {

        $newcomerdetails = $this->newcomerlist();
        $followuplists = $this->followuplist();

        return view('welcome.followup.profile_id', compact('newcomerdetails', 'followuplists'));
    }

    public function getfollowupAssignedCellGroup(Request $request)
    {

        $newcomerdetails = $this->newcomerlist();
        $followuplists = $this->followuplist();

        return view('welcome.followup.assigned_cell_group', compact('newcomerdetails', 'followuplists'));
    }

    public function getfollowupComment(Request $request)
    {

        $newcomerdetails = $this->newcomerlist();
        $followuplists = $this->followuplist();

        return view('welcome.followup.comment', compact('newcomerdetails', 'followuplists'));
    }

    public function getfollowupCommentHistory(Request $request)
    {

        $newcomerdetails = $this->newcomerlist();
        $followuplists = $this->followuplist();

        return view('welcome.followup.comment_history', compact('newcomerdetails', 'followuplists'));
    }
    
    public function postnewcomer(Request $request)
    {
        return redirect('/pastoral/newcomer/')->with('success', 'Success')->with('message', 'Assigned People Successfully');
    }

    public function postfollowupcomment(Request $request)
    {
        return redirect('/followup/')->with('success', 'Success')->with('message', 'Comment Successfully');
    }

    public function postfollowupID(Request $request)
    {
        return redirect('/followup/')->with('success', 'Success')->with('message', 'Assigned Cell Group Successfully');
    }

    public function QRcode(Request $request)
    {

        return view('welcome.QR');
    }

    public function getfollowup(Request $request)
    {

        $followuplists = $this->followuplist();
        $newcomerdetails = $this->newcomerlist();

        return view('welcome.followup', compact('newcomerdetails', 'followuplists'));
    }

    public function getFeedback(Request $request)
    {

        $newcomerdetails = $this->newcomerlist();
        $followuplists = $this->followuplist();

        return view('welcome.feedback', compact('newcomerdetails', 'followuplists'));
    }

    public function getfeedbackHistory(Request $request)
    {

        $newcomerdetails = $this->newcomerlist();
        $followuplists = $this->followuplist();
        
        return view('welcome.feedback.feedback_history', compact('newcomerdetails', 'followuplists'));
    }


    public function getfeedbackRecordHistory(Request $request)
    {

        $newcomerdetails = $this->newcomerlist();
        $followuplists = $this->followuplist();
        
        return view('welcome.feedback.feedback_history_record', compact('newcomerdetails', 'followuplists'));
    }


    public function detail(Request $request)
    {

        return view('welcome.detail');
    }

    public function getChatbook(Request $request)
    {

        $newcomerdetails = $this->newcomerlist();
        $followuplists = $this->followuplist();

        return view('welcome.chatbook', compact('newcomerdetails', 'followuplists'));
    }

    public function postChatbook(Request $request)
    {

        return redirect()->back()->with('success', 'Success')->with('message', 'Question successfully');
    }

    public function getsignup(Request $request)
    {

        return view('welcome.signup');
    }

    public function postsignup(Request $request)
    {

        $this->validate($request, [
            'nric' => [
                'required',
                'unique:souls,nric',
                'regex:/^(\d{6}-\d{2}-\d{4}|[A-PR-WY]\w{6,10})$/'],
            'nric_fullname' => 'required|max:255',
            'email' => 'required|email|unique:souls,email|max:255',
            'nickname' => 'required|max:255',
            'contact' => 'required|between:6,12',
            'address1' => 'required|max:255',
            'address2' => 'required|max:255',
            'birthday' => 'required|date',
            'postal_code' => 'required|digits_between:5,8',

        ]);
        
        $lm = app(\App\Services\Welcome\WelcomeManager::class);
        $souls = $lm->createNewComer(); 

        return redirect()->back()->with('success', trans('event.bible_reading.success'))->with('message', trans('event.bible_reading.success_checkin'));
    }      
}