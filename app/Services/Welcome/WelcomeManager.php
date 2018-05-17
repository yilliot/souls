<?php

namespace App\Services\Welcome;

use App\Models\Soul;
use App\Models\Welcome\WelcomeFollowupper;
use App\Models\Welcome\WelcomeFollowupperComment;

use Carbon\Carbon;
use App\Services\Welcome\WelcomeChatRecordManager;

class WelcomeManager
{
	public function __construct(WelcomeChatRecordManager $chatRecordManager)
	{
		$this->chatRecordManager = $chatRecordManager;
	}

    public function generateQrCode($url, $size = 100, $type = 'png')
    {
    	/**
	     * Generate Qr Code from url.
	     * 
	     * Format available : png, eps, svg
	     *
	     * @return image data url (use as <img src="{{ $qrCode }}" />)
	     */

        return QrCode::format($type)->size($size)->generate($url);
    }

    public function createNewComer($data)
    {
    	/**
    	 * @param $array with 
    	 * nric, nric_fullname, birthday, nickname, email, contact, contact2, 
    	 * address1, address2, postal_code
    	 *
    	 * @return void
    	 */

    	$newComer = new Soul;
    	
    	$newComer->nric =$data['nric'];
    	$newComer->nric_fullname =$data['nric_fullname'];
    	$newComer->birthday =$data['birthday'];
    	$newComer->nickname =$data['nickname'];
    	$newComer->email =$data['email'];
    	$newComer->contact =$data['contact'];
    	$newComer->contact2 =$data['contact2'];
    	$newComer->address1 =$data['address1'];
    	$newComer->address2 =$data['address2'];
    	$newComer->postal_code =$data['postal_code'];
    	$newComer->is_new_comer = true;

    	$newComer->save();

    	$this->chatRecordManager->createWelcomeChatRecord($newComer, $data['accompanion_id']);

    }

    public function getNewComer()
    {
    	/**
    	 * Get a list of new comer 
    	 *
    	 * @return Collection
    	 */

    	$newComers = Soul::where('is_new_comer', true)
    					 ->orderBy('created_at', 'desc')
    					 ->get();

    	return $newComers;
    }

    public function assignFollowUpper($new_comer_id, $followupper_id, $assigner_id)
    {
    	/**
    	 * Assigning new comer to followupper. 
		 *
    	 * Assigner -> Pastoral
    	 * Followupper -> Ministry Member
    	 *
    	 * @return void
    	 */

    	$assignment = new WelcomeFollowupper;
    	$assignment->new_comer_id = $new_comer_id;
    	$assignment->followupper_id = $followupper_id;
    	$assignment->assigner_id = $assigner_id;
    	$assignment->last_comment = Carbon::now();
    	$assignment->save();
    }

    public function getAssignedList($followupper_id)
    {
    	/**
    	 * Get a list of new comer that assigned to current soul.
    	 *
    	 * @return Collection
    	 */

    	// Maybe will not use last comment, but get the comment list in the query.
    	$assignments = WelcomeFollowupper::where('followupper_id', $followupper_id)
    									 ->orderBy('last_comment', 'desc')
    									 ->get();

    	return $assignments;

    }

    public function createComment($new_comer_id, $followupper_id, $comment)
    {
    	/**
    	 * Create a comment to the assignment (Report of the followup from followupper).
    	 * Update the last comment at the assignment.
    	 *
    	 * @return void
    	 */

    	$comment = new WelcomeFollowupComment;
    	$comment->new_comer_id = $new_comer_id;
    	$comment->followupper_id = $followupper_id;
    	$comment->comment = $comment;
    	$comment->save();

    	// If the last comment is not needed this part can be omitted.
    	$assignment = WelcomeFollowupper::where('new_comer_id', $new_comer_id)
    									->where('followupper_id', $followupper_id)
    									->first();
    	$assignment->last_comment = Carbon::now();
    	$assignment->save();
    }

    public function assignConnetGroup($new_comer_id, $cellgroup_id)
    {
    	/**
    	 * Updating the connect group id of the new comer
    	 *
    	 * @return void
    	 */

    	$newComer = Soul::find($new_comer_id);
    	$newComer->cellgroup_id = $cellgroup_id;
    	$newComer->save();
    }

}