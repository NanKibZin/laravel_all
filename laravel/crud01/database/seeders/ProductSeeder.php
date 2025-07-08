<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products=[
        [
            'name' => 'Product 1',
            'price' => 10.99,
            'des' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'qty'=>1,
            'created_at' =>now(),
            'updated_at' =>now(),
        ],
        [
            'name' => 'Product 2',
            'price' => 10.99,
            'qty'=>1,
            'des' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'created_at' =>now(),
            'updated_at' => now(),
        ]
        ];
        //build Query
        DB::table('products')->insert($products);
    }
}
