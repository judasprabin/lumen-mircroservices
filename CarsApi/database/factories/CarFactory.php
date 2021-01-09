<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Car::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'make' => $this->faker->randomElement(['Toyota', 'BMW', 'Mercedez']),
            'model' => $this->faker->numerify('Model ###'),
            'year' => $this->faker->numberBetween($min = 2000, $max = 2020),
            'purchase_price' => $this->faker->numberBetween($min = 40000, $max = 90000),
            'current_value' => $this->faker->numberBetween($min = 5000, $max = 40000),
            'owner_id' => $this->faker->numberBetween($min = 1, $max = 50),
        ];
    }
}
