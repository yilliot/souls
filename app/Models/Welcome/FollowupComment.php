<<<<<<< HEAD
<?php

namespace App\Models\Welcome;

use Illuminate\Database\Eloquent\Model;

class FollowupComment extends Model
{
    protected $table = 'welcome_followup_comments';
}
||||||| merged common ancestors
=======
<?php

namespace App\Models\Welcome;

use Illuminate\Database\Eloquent\Model;
use App\Models\Soul;

class FollowupComment extends Model
{
    protected $table = 'welcome_followup_comments';

    public function followupComment()
    {
    	return $this->belongsTo(Soul::class, 'followupper_id');
    }
    public function followupper()
    {
    	return $this->belongsTo(Followupper::class, 'followupper_id');
    }
    /*
	public function followupper()
	{
		return $this->belongsTo(Soul::class, 'followupper_id');
	}
    */

}
>>>>>>> origin/feature/welcome/layout
