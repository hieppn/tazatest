<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => 'LG',
            'description' => "vip",
            'price' => 12,
            'category_id' => 1
        ]);
        DB::table('products')->insert([
            'name' => 'SamSung',
            'description' => "vip",
            'price' => 12,
            'category_id' => 1
        ]);
        DB::table('products')->insert([
            'name' => 'Sony',
            'description' => "vip",
            'price' => 12,
            'category_id' => 1
        ]);
    }
}
