<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call(CoreSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(CgSeeder::class);

        // FOREIGN_KEY_CHECKS is supposed to only apply to a single
        // connection and reset itself but I like to explicitly
        // undo what I've done for clarity
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
