<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Welcome\WelcomeManager;

class PastoralController extends Controller
{
    //
    public function __construct(WelcomeManager $welcomeManager)
    {
    	$this->welcomeManager = $welcomeManager;
    }

    public function postAssignFollowupper()
    {
    	$this->welcomeManager->assignFollowUpper();
    	return redirect('pastoral/newcomer');
    }
}
