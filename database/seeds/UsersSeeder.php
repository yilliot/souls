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
        // Role::truncate();
        // DB::table('role_user')->truncate();
        // User::truncate();

        $role = new Role();
        $roleRootAdmin = $role->create([
            'name' => 'Root Admin',
            'slug' => 'root_admin',
            'description' => 'root administrator',
        ]);

        $role = new Role();
        $roleCgl = $role->create([
            'name' => 'CG Leader',
            'slug' => 'cgl',
            'description' => 'CG Leader'
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

    }
}
