<?php

use Illuminate\Database\Seeder;
use App\Models\Events\BibleReading\Chapter;

class BibleChapterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Chapter::truncate();

        $bible_books = [
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
        // CG

        foreach ($bible_books as $book_name => $chapter_number) {
            for ($chapter = 1; $chapter <= $chapter_number; $chapter++) { 
                DB::table('chapters')->insert(['book_name' => $book_name, 'chapter_number' => $chapter]);
            }
        }
    }
}
