<?php

use Illuminate\Database\Seeder;

class JobsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Job::class, 10)->create(['seller_id'=>'4']);
        factory(App\Models\Job::class, 5)->create(['seller_id'=>'5']);
        factory(App\Models\Job::class, 5)->create(['seller_id'=>'6']);
        DB::table('job_areas')->insert(['job_id' => 1, 'area_id' => 1120101]);
        DB::table('job_areas')->insert(['job_id' => 1, 'area_id' => 1090101]);
        DB::table('job_areas')->insert(['job_id' => 1, 'area_id' => 1010101]);
        DB::table('job_areas')->insert(['job_id' => 2, 'area_id' => 1120101]);
        DB::table('job_areas')->insert(['job_id' => 3, 'area_id' => 1120101]);
        DB::table('job_areas')->insert(['job_id' => 4, 'area_id' => 1090101]);
        DB::table('job_areas')->insert(['job_id' => 5, 'area_id' => 1090101]);
        DB::table('job_areas')->insert(['job_id' => 6, 'area_id' => 1090101]);
        DB::table('job_areas')->insert(['job_id' => 7, 'area_id' => 1090101]);
        DB::table('job_areas')->insert(['job_id' => 8, 'area_id' => 1090101]);
        DB::table('job_areas')->insert(['job_id' => 9, 'area_id' => 1090101]);
        DB::table('job_areas')->insert(['job_id' => 10, 'area_id' => 1090101]);
    }
}
