<?php

use Illuminate\Database\Seeder;

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('session_types')->insert(['name' => 'Saturday Service']);
        DB::table('session_types')->insert(['name' => 'Sunday Service']);
        DB::table('session_types')->insert(['name' => 'Children Service']);
        DB::table('session_types')->insert(['name' => 'Special Service']);
        DB::table('session_types')->insert(['name' => 'Connect Group']);
        DB::table('session_types')->insert(['name' => 'Leaders Training']);

        DB::table('session_venues')->insert(['name' => 'OASIS JB']);

        DB::table('session_speakers')->insert(['name' => 'Pr Gin']);
        DB::table('session_speakers')->insert(['name' => 'Pr Kevin']);
        DB::table('session_speakers')->insert(['name' => 'Pr Keith']);
        DB::table('session_speakers')->insert(['name' => 'Pr Daniel']);
        DB::table('session_speakers')->insert(['name' => 'Pr Garrick']);
        DB::table('session_speakers')->insert(['name' => 'Xuxu']);
        DB::table('session_speakers')->insert(['name' => 'Ryan']);
        DB::table('session_speakers')->insert(['name' => '...Leaders']);

    }
}
