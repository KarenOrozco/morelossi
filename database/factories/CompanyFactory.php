<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->word(20);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->text(250),
            'status' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'priority' => $this->faker->randomElement([1, 2, 3, 4, 5])
            // 'user_id' => User::all()->random()->id()
        ];
    }
}
