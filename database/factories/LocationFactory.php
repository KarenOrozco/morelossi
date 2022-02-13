<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Location::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'street' => $this->faker->unique()->word(20),
            'number' => $this->faker->randomNumber(),
            'postal_code' => $this->faker->numerify('###'),
            'reference' => $this->faker->text(),
            'city_id' => City::whereNotNull('parent_id')->get()->random()->id
        ];
    }
}
