<?php

use Illuminate\Database\Seeder;

use App\Models\Ministry;

class CoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ministry::truncate();

        $default = [
            'created_at'=> \Carbon\Carbon::now()
        ];

        DB::table('service_speakers')->insert(['id' => 1, 'name' => 'Pastor Joshua']);
        DB::table('service_speakers')->insert(['id' => 2, 'name' => 'Xuxu']);
        DB::table('service_speakers')->insert(['id' => 3, 'name' => 'Pastor Kevin']);
        DB::table('service_speakers')->insert(['id' => 4, 'name' => 'Pastor Keith']);
        DB::table('service_speakers')->insert(['id' => 5, 'name' => 'Pastor Garrick']);
        DB::table('service_speakers')->insert(['id' => 6, 'name' => 'Pastor Daniel']);

        DB::table('service_types')->insert(['id' => 1, 'name' => 'Saturday']);
        DB::table('service_types')->insert(['id' => 2, 'name' => 'Supreme']);

        DB::table('service_venues')->insert(['id' => 1, 'name' => 'OASIS']);


        // ministries
        DB::table('ministries')->insert($default + ['id' => 1,  'shortname' => 'Hospitality', 'fullname' => 'Hospitality']);
        DB::table('ministries')->insert($default + ['id' => 2,  'shortname' => 'ICT', 'fullname' => 'Info Comm Tech']);
        DB::table('ministries')->insert($default + ['id' => 3,  'shortname' => 'Lighting', 'fullname' => 'Lighting']);
        DB::table('ministries')->insert($default + ['id' => 4,  'shortname' => 'Social Media', 'fullname' => 'Social Media']);
        DB::table('ministries')->insert($default + ['id' => 5,  'shortname' => 'Sound', 'fullname' => 'Sound']);
        DB::table('ministries')->insert($default + ['id' => 6,  'shortname' => 'Design', 'fullname' => 'Design']);
        DB::table('ministries')->insert($default + ['id' => 7,  'shortname' => 'Photo', 'fullname' => 'Photo']);
        DB::table('ministries')->insert($default + ['id' => 8,  'shortname' => 'Video', 'fullname' => 'Video']);
        DB::table('ministries')->insert($default + ['id' => 9,  'shortname' => 'Translate', 'fullname' => 'Translate']);
        DB::table('ministries')->insert($default + ['id' => 10, 'shortname' => 'Usher', 'fullname' => 'Usher']);
        DB::table('ministries')->insert($default + ['id' => 11, 'shortname' => 'VC', 'fullname' => 'Visual Comm']);
        DB::table('ministries')->insert($default + ['id' => 12, 'shortname' => 'Worship', 'fullname' => 'Worship']);
        DB::table('ministries')->insert($default + ['id' => 13, 'shortname' => 'Facility', 'fullname' => 'Facility']);

    }
}
