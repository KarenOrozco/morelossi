<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'url' => $this->faker->image('public/storage', 640, 480, null, false),
            'priority' => $this->faker->randomElement([1, 2, 3, 4, 5])
        ];
    }

    public function companyImage()
    {
        return $this->state(function (array $attributes) {
            return [
                'url' => 'companies/' . $this->faker->image('public/storage/companies', 640, 480, null, false),
            ];
        });
    }

    public function userImage()
    {
        return $this->state(function (array $attributes) {
            return [
                'url' => 'users/' . $this->faker->image('public/storage/users', 640, 480, null, false),
            ];
        });
    }

    public function categoryImage()
    {
        return $this->state(function (array $attributes) {
            return [
                'url' => 'categories/' . $this->faker->image('public/storage/categories', 640, 480, null, false),
            ];
        });
    }

    public function cityImage()
    {
        return $this->state(function (array $attributes) {
            return [
                'url' => 'cities/' . $this->faker->image('public/storage/cities', 640, 480, null, false),
            ];
        });
    }

}
