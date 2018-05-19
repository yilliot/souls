<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Welcome\WelcomeManager;

class UsherController extends Controller
{
    //
    public function __construct(WelcomeManager $welcomeManager)
    {
        $this->welcomeManager = $welcomeManager;
    }

    public function postWelcomeCard()
    {
        $details = $this->welcomeManager->createNewComer();
        return redirect('usher/welcome');//remember to create a welcome thank you page.
    }

    public function getWelcomeCard()
    {
        $details = $this->welcomeManager->getNewComer();
        return view();
    }

    public function getQR(Request $request)
    {
        // $url = config('app.url') . '/usher/details?accompanion_id=13';
        $url = config('app.url') . '/usher/details?accompanion_id=' . \Auth::user()->id;
        return view('welcome.QR', compact('url'));
    }
}
