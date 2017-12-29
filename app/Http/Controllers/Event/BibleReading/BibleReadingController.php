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
        $comments = Comment::where('created_at', '>=', $yesterday)->get()->sortByDesc('created_at');
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

        $topScore = $count? max($count):1;
        for($i = 1; $i <= 4; $i++){
          if(isset($count[$i])) $totals[$i]['count'] = $count[$i];
        }
        return view('event.bible_reading.home', compact('comments', 'totals', 'topScore'));
    }

    public function signup()
    {
        return view('event.bible_reading.signup');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('nric');
        return redirect('event/bible_reading')->with('success', trans('event.bible_reading.success_logout'));
    }

    public function checkin()
    {
        $books = trans('event.bible_reading.bible_books');
        return view('event.bible_reading.checkin', compact('books'));
    }

    public function history()
    {
        $soul = Soul::where('nric', session('nric'))->first();
        $old_test = [];
        $new_test = [];
        $status = [];
        $i = 1;
        $check_in = CheckIn::where('soul_id', $soul->id)->get();

        foreach ($this->bible_books as $book => $chapter) {
          if($i++ <= 39) $old_test[$book] = $chapter;
          else $new_test[$book] = $chapter;
          $status[$book] = [];
          for($j = 1; $j <= $chapter; $j++) {
            $status[$book][$j] = 0;
          }
        }
        $chapters = [];
        foreach ($check_in as $value) {
          $chapters[] = CheckInChapter::where('check_in_id', $value->id)->get()->pluck('chapter_id');
        }
        foreach ($chapters as $chapter) {
          foreach ($chapter as $id) {
            foreach ($this->bible_books as $book => $chapter_num) {
              if($id - $chapter_num > 0) {
                $id -= $chapter_num;
              }
              else {
                $chapter_data['book_name'] = $book;
                $chapter_data['chapter_number'] = $id;
                break;
              }
            }
            $status[$chapter_data['book_name']][$chapter_data['chapter_number']] = 1;
          }
        }

        $amount = $this->countRecord($check_in);
        return view('event.bible_reading.history', compact('old_test', 'new_test', 'status', 'amount'));
    }

    public function showHistory($book, $verse)
    {
        $chapter = Chapter::where('book_name', $book)
                           ->where('chapter_number', $verse)
                           ->first();
        $comments = $chapter->comment()->get()->sortByDesc('created_at');
        $type = 'chapter';
        return view('event.bible_reading.show_comments', compact('comments', 'type'));
    }

    public function countRecord($check_in)
    {
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
                    ->get()->sortByDesc('created_at');
        $type = 'soul';
        $check_in = CheckIn::where('soul_id', $soul->id)->get();
        $amount = $this->countRecord($check_in);
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

        $soul = Soul::where('nric', $request->nric)->first();
        
        $check_in = new CheckIn();
        $check_in->soul_id = $soul->id;
        $check_in->save();

        $comments = $request->comment;

        foreach ($request->chapters as $chapter => $status) {
            if($status == 0) continue;
            $check_in_chapter = new CheckInChapter;
            $check_in_chapter->check_in_id = $check_in->id;
            $check_in_chapter->cellgroup_id = $soul->cellgroup_id;
            $check_in_chapter->chapter_id = $chapter + $this->culm_chapter[$request->book];
            $check_in_chapter->save();
            if(isset($comments[$chapter + 1]) && $comments[$chapter + 1] != '') {
            
                $comment = new Comment();
                $comment->content = $comments[$chapter + 1];
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

    public function getSchedule()
    {
        return view('event.bible_reading.schedule');
    }

    protected $bible_books = [
            'Gen' => 50,
            'Ex' => 40,
            'Lev' => 27,
            'Num' => 36,
            'Deut' => 34,
            'Josh' => 24,
            'Judg' => 21,
            'Ruth' => 4,
            '1Sam' => 31,
            '2Sam' => 24,
            '1Kings' => 22,
            '2Kings' => 25,
            '1Chron' => 29,
            '2Chron' => 36,
            'Ezra' => 10,
            'Neh' => 13,
            'Est' => 10,
            'Job' => 42,
            'Ps' => 150,
            'Prov' => 31,
            'Eccles' => 12,
            'Song' => 8,
            'Isa' => 66,
            'Jer' => 52,
            'Lam' => 5,
            'Ezek' => 48,
            'Dan' => 12,
            'Hos' => 14,
            'Joel' => 3,
            'Amos' => 9,
            'Obad' => 1,
            'Jonah' => 4,
            'Mic' => 7,
            'Nah' => 3,
            'Hab' => 3,
            'Zeph' => 3,
            'Hag' => 2,
            'Zech' => 14,
            'Mal' => 4,
            'Matt' => 28,
            'Mark' => 16,
            'Luke' => 24,
            'John' => 21,
            'Acts' => 28,
            'Rom' => 16,
            '1Cor' => 16,
            '2Cor' => 13,
            'Gal' => 6,
            'Eph' => 6,
            'Phil' => 4,
            'Col' => 4,
            '1Thess' => 5,
            '2Thess' => 3,
            '1Tim' => 6,
            '2Tim' => 4,
            'Titus' => 3,
            'Philemon' => 1,
            'Heb' => 13,
            'James' => 5,
            '1Pet' => 5,
            '2Pet' => 3,
            '1John' => 5,
            '2John' => 1,
            '3John' => 1,
            'Jude' => 1,
            'Rev' => 22,
        ];

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