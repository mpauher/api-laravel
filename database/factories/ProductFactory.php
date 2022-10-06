<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'serial'          =>  $this->faker->unique()->numberBetween($min = 1000, $max = 9000),
            'name'            =>  $this->faker->word,
            'price'           =>  $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = NULL),
            'quantity'        =>  $this->faker->numberBetween($min = 10, $max = 1000),
            'description'     =>  $this->faker->text($maxNbChars = 50),
        ];
    }
}
