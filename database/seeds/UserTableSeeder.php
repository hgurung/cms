<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([

            [
              'id' => 1,
              'name'=>'Ekbana',
              'username'=>'admin',
              'email'=>'info@ekbana.com',
              'password'=> bcrypt('123admin@'),
            ]
        ]);
    }
}
