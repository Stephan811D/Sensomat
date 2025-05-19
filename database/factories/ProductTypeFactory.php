<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProductType;

class ProductTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'productType' => $this->faker->randomElement($array = array ('Zigaretten','Snus','Zigarren')),
            'productDepth' => $this->faker->numberBetween($min = 200, $max = 300)
        ];
    }
}
