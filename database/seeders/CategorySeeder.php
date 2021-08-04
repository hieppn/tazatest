<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'TV',
            'description' => "vip"
        ]);
        DB::table('categories')->insert([
            'name' => 'Phone',
            'description' => "vip"
        ]);
        DB::table('categories')->insert([
            'name' => 'Laptop',
            'description' => "vip"
        ]);
    }
}
