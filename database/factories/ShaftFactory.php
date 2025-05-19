<?php

namespace Database\Factories;

use App\Models\Shaft;
use App\Models\Product;

use Illuminate\Database\Eloquent\Factories\Factory;

class ShaftFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Shaft::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'automat_id' => '1',
            'product_id' => Product::inRandomOrder()->first()->id,
            'measuredShaftLength' => $this->faker->randomElement($array = array ('220','420','640')),
            'capacity' => $this->faker->randomElement($array = array ('10','20','30')),
            'level' => $this->faker->numberBetween($min = 0, $max = 10),
            'errorCode' => $this->faker->numberBetween($min = 0, $max = 3),
        ];
    }
}
