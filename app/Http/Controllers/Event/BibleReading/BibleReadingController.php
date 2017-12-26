<?php

namespace App\Http\Controllers\Event\BibleReading;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Events\BibleReading\Chapter;
use App\Models\Events\BibleReading\CheckIn;
use App\Models\Events\BibleReading\CheckInChapter;
use App\Models\Events\BibleReading\Comment;
use App\Models\Soul;

class BibleReadingController extends Controller
{
    public function home()
    {
        $yesterday = date("Y-m-d-h-m-s", strtotime( '-1 days' ) );
        $comments = Comment::where('created_at', '>=', $yesterday)->get();
        $check_in_chapter = CheckInChapter::all()->pluck('cellgroup_id', 'id');
        $count = array_count_values($check_in_chapter->toArray());
        $totals = [
          1 => [
            'name' => 'W1',
            'color' => 'red',
            'count' => 0,
          ],
          2 => [
            'name' => 'S1',
            'color' => 'green',
            'count' => 0,
          ],
          3 => [
            'name' => 'E1',
            'color' => 'blue',
            'count' => 0,
          ],
          4 => [
            'name' => 'E2',
            'color' => 'yellow',
            'count' => 0,
          ],
        ];
        $topScore = max($count);
        for($i = 1; $i <= 4; $i++){
          if(isset($count[$i])) $totals[$i]['count'] = $count[$i];
        }
        return view('event.bible_reading.home', compact('comments', 'totals', 'topScore'));
    }

    public function signup()
    {
        return view('event.bible_reading.signup');
    }

    public function signout(Request $request)
    {
        $request->session()->forget('nric');
        return redirect('event/bible_reading')->with('success', trans('event.bible_reading.success_signout'));
    }

    public function checkin()
    {
        $books = trans('event.bible_reading.bible_books');
        return view('event.bible_reading.checkin', compact('books'));
    }

    public function history()
    {
        $soul = Soul::where('nric', session('nric'))->first();
        $books = trans('event.bible_reading.bible_books');
        $old_test = [];
        $new_test = [];
        $status = [];
        $i = 1;
        foreach($books as $book => $value){
          $state = [];
          if($i++ <=39) {
            $old_test[$book] = Chapter::where('book_name', $book)->count();
            for($j = 0; $j < $old_test[$book]; $j++) {
              $id = $this->culm_chapter[$book] + $j;
              $check_in_chapters = Chapter::find($id)->checkInChapter()->get();
              $state[$j] = 0;
              foreach ($check_in_chapters as $check_in_chapter) {
                $state[$j] = $check_in_chapter->checkIn()->first()->soul()->first()->id == $soul->id ? 1:0;
              }
            }
          }
          else {
            $new_test[$book] = Chapter::where('book_name', $book)->count();
            for($j = 0; $j < $new_test[$book]; $j++) {
              $id = $this->culm_chapter[$book] + $j;
              $check_in_chapters = Chapter::find($id)->checkInChapter()->get();
              $state[$j] = 0;
              foreach ($check_in_chapters as $check_in_chapter) {
                $state[$j] = $check_in_chapter->checkIn()->first()->soul()->first()->id == $soul->id ? 1:0;
              }
            }
          }
          $status[$book] = $state;
        }
        $amount = $this->countRecord($soul);
        return view('event.bible_reading.history', compact('old_test', 'new_test', 'status', 'amount'));
    }

    public function showHistory($book, $verse)
    {
        $chapter = Chapter::where('book_name', $book)
                           ->where('chapter_number', $verse)
                           ->first();
        $comments = $chapter->comment()->get();
        $type = 'chapter';
        return view('event.bible_reading.show_comments', compact('comments', 'type'));
    }

    public function countRecord($soul)
    {
        $check_in = CheckIn::where('soul_id', $soul->id)->get();
        $check_in_chapter = [];
        foreach ($check_in as $checkIn) {
          $check_in_chapter[] = $checkIn->checkInChapter()->get();
        }
        $amount = collect([$check_in_chapter])->collapse()->collapse()->pluck('chapter_id')->unique()->count();
        return $amount;
    }

    public function showMyHistory()
    {
        $soul = Soul::where('nric', session('nric'))->first();
        $comments = Comment::where('soul_id', $soul->id)
                    ->get();
        $type = 'soul';
        $amount = $this->countRecord($soul);
        return view('event.bible_reading.show_comments', compact('comments', 'type', 'amount'));
    }

    public function nric()
    {
        return view('event.bible_reading.nric');
    }

    // Post
    public function postSignup(Request $request)
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
            'cellgroup_id' => 'required|exists:cellgroups,id',
        ]);

        session()->put('nric', $request->nric);

        $contact_string = preg_replace('/\s+/', '', $request->contact);
        $contact_string = $request->contact_code . ltrim($contact_string, '0');

        $soul = new Soul;
        $soul->cellgroup_id = $request->cellgroup_id;
        $soul->nric = $request->nric;
        $soul->nric_fullname = $request->nric_fullname;
        $soul->birthday = $request->birthday;
        $soul->nickname = $request->nickname;
        $soul->email = $request->email;
        $soul->contact = $contact_string;
        $soul->address1 = $request->address1;
        $soul->address2 = $request->address2;
        $soul->postal_code = $request->postal_code;
        $soul->save();

        return redirect('/event/bible_reading/checkin')->with('success', 'success')->with('message', trans('event.bible_reading.signup_success') . $soul->nric);
    }

    public function postCheckin(Request $request)
    {
        $this->validate($request, [
            'nric' => [
                'required',
                'regex:/^(\d{6}-\d{2}-\d{4}|[A-PR-WY]\w{6,10})$/'],
                'exists:souls,nric',
        ]);
        if(!$request->comment)return back()->with('error', trans('event.bible_reading.comment_cannot_empty'));
        $count = array_count_values($request->chapters);
        $flag = array_key_exists(2, $count);
        if(!$flag) return back()->with('error', trans('event.bible_reading.must_has_one_main_chapter'));

        $soul = Soul::where('nric', $request->nric)->first();
        
        $check_in = new CheckIn();
        $check_in->soul_id = $soul->id;
        $check_in->save();


        foreach ($request->chapters as $chapter => $status) {
            if($status == 0) continue;
            $check_in_chapter = new CheckInChapter;
            $check_in_chapter->check_in_id = $check_in->id;
            $check_in_chapter->cellgroup_id = $soul->cellgroup_id;
            $check_in_chapter->chapter_id = $chapter + $this->culm_chapter[$request->book];
            $check_in_chapter->save();
            if($status == 2) {
                
                $comment = new Comment();
                $comment->content = $request->comment;
                $comment->soul_id = $soul->id;
                $comment->check_in_chapter_id = $check_in_chapter->id;
                $comment->save();

                $check_in_chapter->comment_id = $comment->id;
                $check_in_chapter->save();
            }
        }

        return redirect('/event/bible_reading')->with('success', trans('event.bible_reading.success'))->with('message', trans('event.bible_reading.success_checkin'));

    }

    public function postNric(Request $request)
    {
        $this->validate($request, [
            'nric' => [
                'required',
                'regex:/^(\d{6}-\d{2}-\d{4}|[A-PR-WY]\w{6,10})$/'],
                'exists:souls,nric',
        ]);
        $request->session()->put('nric', $request->nric);

        return redirect()->intended('event/bible_reading/history');
    }

    protected $culm_chapter = [
              "Gen" => 1,
              "Ex" => 51,
              "Lev" => 91,
              "Num" => 118,
              "Deut" => 154,
              "Josh" => 188,
              "Judg" => 212,
              "Ruth" => 233,
              "1Sam" => 237,
              "2Sam" => 268,
              "1Kings" => 292,
              "2Kings" => 314,
              "1Chron" => 339,
              "2Chron" => 368,
              "Ezra" => 404,
              "Neh" => 414,
              "Est" => 427,
              "Job" => 437,
              "Ps" => 479,
              "Prov" => 629,
              "Eccles" => 660,
              "Song" => 672,
              "Isa" => 680,
              "Jer" => 746,
              "Lam" => 798,
              "Ezek" => 803,
              "Dan" => 851,
              "Hos" => 863,
              "Joel" => 877,
              "Amos" => 880,
              "Obad" => 889,
              "Jonah" => 890,
              "Mic" => 894,
              "Nah" => 901,
              "Hab" => 904,
              "Zeph" => 907,
              "Hag" => 910,
              "Zech" => 912,
              "Mal" => 926,
              "Matt" => 930,
              "Mark" => 958,
              "Luke" => 974,
              "John" => 998,
              "Acts" => 1019,
              "Rom" => 1047,
              "1Cor" => 1063,
              "2Cor" => 1079,
              "Gal" => 1092,
              "Eph" => 1098,
              "Phil" => 1104,
              "Col" => 1108,
              "1Thess" => 1112,
              "2Thess" => 1117,
              "1Tim" => 1120,
              "2Tim" => 1126,
              "Titus" => 1130,
              "Philemon" => 1133,
              "Heb" => 1134,
              "James" => 1147,
              "1Pet" => 1152,
              "2Pet" => 1157,
              "1John" => 1160,
              "2John" => 1165,
              "3John" => 1166,
              "Jude" => 1167,
              "Rev" => 1168,
        ];
}