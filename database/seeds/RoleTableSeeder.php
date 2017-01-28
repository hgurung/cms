<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            [
                'id'   => 1,
                'name' => 'superuser',
            ]
        ]);

        DB::table('role_user')->insert([
            [
                'user_id' => 1,
                'role_id' => 1,
            ]
        ]);
    }
}
