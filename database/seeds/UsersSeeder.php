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
        $roleAppUser = $role->create([
            'name' => 'App User',
            'slug' => 'app_user',
            'description' => 'app user'
        ]);


        // create user
        $root_admin_user = factory(User::class)->create([
            'email' => 'admin@timev.co'
            ]);
        $app_user01 = factory(User::class)->create();
        $app_user02 = factory(User::class)->create();
        $app_user03 = factory(User::class)->create([
            'email' => 'demoseller@timev.co'
            ]);
        $app_user04 = factory(User::class)->create([
            'email' => 'demoseller_pending@timev.co'
            ]);
        $app_user05 = factory(User::class)->create([
            'email' => 'demoseller_rejected@timev.co'
            ]);

        $root_admin_user->assignRole($roleRootAdmin);
        $app_user01->assignRole($roleAppUser);
        $app_user02->assignRole($roleAppUser);

        factory(App\Models\UserSeller::class)->create([
            'id' => 4,
            'approval_code' => 1,
        ]);
        factory(App\Models\UserSeller::class)->create([
            'id' => 5,
            'approval_code' => 0,
        ]);
        factory(App\Models\UserSeller::class)->create([
            'id' => 6,
            'approval_code' => 2,
        ]);

    }
}
