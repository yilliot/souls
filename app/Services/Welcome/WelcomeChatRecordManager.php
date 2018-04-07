<?php

namespace App\Services\Welcome;

use App\Models\Soul;
use App\Models\Welcome\WelcomeChatRecord;

class WelcomeChatRecordManager
{

    public function createWelcomeChatRecord(Soul $newComer, $accompanion_id)
    {
    	/**
    	 * Create welcome chat record to be update from the followupper.
    	 *
    	 * @param App\Models\Soul;
    	 *
    	 * @return void
    	 */

    	$chatRecord = new WelcomeChatRecord;

    	$chatRecord->new_comer_id = $newComer->id;
    	$chatRecord->accompanion_id = $data['accompanion_id'];
    	
    	$chatRecord->save();

    }

    public function welcomeChatRecordIndex(Soul $accompanion)
    {
        /**
         * Get a collection of record based on the logged in soul.
         *
         * @param App\Models\Soul;
         *
         * @return Collection
         */

        $chatRecords = WelcomeChatRecord::where('accompanion_id', $accompanion->id)
                                        ->where('record', null)
                                        ->get();

        return $chatRecords;
    }

    public function getWelcomeChatRecord($accompanion_id, $new_comer_id)
    {
        /**
         * Get the selected chat record.
         *
         * @param integer;
         *
         * @return Single Object
         */

        $chatRecord = WelcomeChatRecord::where('accompanion_id', $accompanion_id)
                                       ->where('new_comer_id', $new_comer_id)
                                       ->first();

        return $chatRecord;
    }

    public function updateWelcomeChatRecord($accompanion_id, $new_comer_id, $record)
    {
        /**
         * Update the record with string of the questions and answer.
         *
         * @param integer, string;
         *
         * @return void
         */

        $chatRecord = $this->getWelcomeChatRecord($accompanion_id, $new_comer_id);
        $chatRecord->record = $record;
        $chatRecord->save();
    }
}