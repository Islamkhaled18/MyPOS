<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::create([

            "first_name"=>'super',
            "last_name"=> 'admin',
            'email'=>'ahmed@gmail.com',
            'password' => bcrypt('123456789'),

        ]);

        $user->attachRole('superadministrator');
        $user->attachRole('admin');

    }
}
