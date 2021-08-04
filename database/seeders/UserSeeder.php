<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Hiep',
            'email'=>'amdin@gmail.com',
            'password'=>'12345'
        ]);
        DB::table('users')->insert([
            'name' => 'Hanh',
            'email'=>'a@gmail.com',
            'password'=>'12345'
        ]);
    }
}
