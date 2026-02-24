<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->insert([
            'name' => 'Men\'s Cruiser Slip On',
            'category' => 'slip-ons',
            'price' => 432.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
