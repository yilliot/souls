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
    	$qrCode = $this->welcomeManager->generateQrCode('dummy');
    	return view();
    	return redirect('');
    }
}
