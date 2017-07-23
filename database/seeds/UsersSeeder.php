<?php

use Illuminate\Database\Seeder;
use Kodeine\Acl\Models\Eloquent\Role;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();
        DB::table('role_user')->truncate();
        User::truncate();

        $role = new Role();
        $roleRootAdmin = $role->create([
            'name' => 'Root Admin',
            'slug' => 'root_admin',
            'description' => 'root administrator',
        ]);

        $role = new Role();
        $roleCgl = $role->create([
            'name' => 'Cellgroup Leader',
            'slug' => 'cgl',
            'description' => 'Cellgroup Leader'
        ]);

        $role = new Role();
        $roleMl = $role->create([
            'name' => 'Ministry Leader',
            'slug' => 'ml',
            'description' => 'Ministry Leader'
        ]);

        $role = new Role();
        $roleMl = $role->create([
            'name' => 'Pastoral',
            'slug' => 'pastoral',
            'description' => 'Pastoral'
        ]);

        $default = [
            'password' => bcrypt('secret'),
            'remember_token' => str_random(10),
            'created_at'=> \Carbon\Carbon::now(),
        ];

        DB::table('users')->insert($default + ['first_name' => 'Elliot', 'last_name' => 'Yap', 'email' => 'yilliot@gmail.com']);
        DB::table('users')->insert($default + ['first_name' => 'Chin Pheng', 'last_name' => 'Tan', 'email' => 'tcpheng92@gmail.com']);
        DB::table('users')->insert($default + ['first_name' => 'Woei Jye', 'last_name' => 'Lian', 'email' => 'ryanlian1992@gmail.com']);
        DB::table('users')->insert($default + ['first_name' => 'Ruan Ching', 'last_name' => 'Yeo', 'email' => 'rcyang1006@gmail.com']);
        DB::table('users')->insert($default + ['first_name' => 'Joshua', 'last_name' => 'Lew', 'email' => 'joshualew1.618@gmail.com']);

        $default = [
            'created_at'=> \Carbon\Carbon::now(),
        ];
        DB::table('role_user')->insert($default + ['role_id' => 1, 'user_id' => 1]);
        DB::table('role_user')->insert($default + ['role_id' => 3, 'user_id' => 1]);
        DB::table('role_user')->insert($default + ['role_id' => 2, 'user_id' => 2]);
        DB::table('role_user')->insert($default + ['role_id' => 2, 'user_id' => 3]);
        DB::table('role_user')->insert($default + ['role_id' => 2, 'user_id' => 4]);
        DB::table('role_user')->insert($default + ['role_id' => 2, 'user_id' => 5]);


    }
}
