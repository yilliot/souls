<?php

use Illuminate\Database\Seeder;
use Kodeine\Acl\Models\Eloquent\Role;
use App\Models\Soul;
use App\Models\Cellgroup;

class CgSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cellgroup::truncate();
        Soul::truncate();

        $default = [
            'created_at'=> \Carbon\Carbon::now()
        ];

        // CG
        DB::table('cellgroups')->insert($default + ['id' => 1, 'leader' => 2, 'name' => 'W1']);
        DB::table('cellgroups')->insert($default + ['id' => 2, 'leader' => 3, 'name' => 'S1']);
        DB::table('cellgroups')->insert($default + ['id' => 3, 'leader' => 4, 'name' => 'E1']);
        DB::table('cellgroups')->insert($default + ['id' => 4, 'leader' => 5, 'name' => 'E2']);


        factory(Soul::class, 10)->create();

    }
}
