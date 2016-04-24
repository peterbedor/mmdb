<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'First',
            'last_name' => 'McLasty',
            'email' => 'firstlast@gmail.com',
            'password' => bcrypt('password')
        ]);
    }
}
