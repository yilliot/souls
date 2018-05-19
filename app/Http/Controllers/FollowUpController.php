<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Welcome\WelcomeManager;

class FollowUpController extends Controller
{
    //
    public function __construct(WelcomeManager $welcomeManager)
    {
    	$this->welcomeManager = $welcomeManager;
    }

    public function index()
    {
    	$this->welcomeManager->getAssignedList();
    	return view();
    }

    public function postFollowuppperComments()
    {
    	$this->welcomeManager->createComment();
    	return redirect('followup');
    }

    public function postAssignCg()
    {
    	$this->welcomeManager->assignConnetGroup();
    	return redirect('followup');
    }
}
