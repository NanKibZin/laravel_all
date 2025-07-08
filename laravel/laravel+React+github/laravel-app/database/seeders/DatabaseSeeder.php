<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker; 

class DatabaseSeeder extends Seeder
{
    
    public function run()
    {
        $faker = Faker::create();

        // Insert multiple fake products
        for ($i = 0; $i < 10; $i++) { 
            Product::create([
                'name' => $faker->word,
                'image' => $faker->imageUrl(), 
                'qty' => $faker->numberBetween(1, 100),  
                'price' => $faker->randomFloat(2, 5, 100), 
                'note' => $faker->sentence,
            ]);
        }
    }
}
