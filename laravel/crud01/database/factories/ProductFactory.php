<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           "name"=>$this->faker->text(15),
           "des"=>$this->faker->text(50),
           "price"=>$this->faker->numberBetween(2, 0, 100),
           "qty"=>$this->faker->numberBetween(1, 100),
           "created_at"=>now(),
           "updated_at"=>now(),
        ];   
    }
}
