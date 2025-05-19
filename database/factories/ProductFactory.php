<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductType;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'productType_id' => ProductType::inRandomOrder()->first()->id,
            'productName' => $this->faker->company,
            'price' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 10),
            'color' => $this->faker->shuffle('ace258')
        ];
    }
}
