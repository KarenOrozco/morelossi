<?php

namespace Database\Factories;

use App\Models\WorkShedule;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkSheduleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WorkShedule::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start_time' => $this->faker->time(),
            'finish_time' => $this->faker->time(),
            'day' => $this->faker->randomElement([1, 2, 3, 4, 5, 6, 7])
        ];
    }
}
