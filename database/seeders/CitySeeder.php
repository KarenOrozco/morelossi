<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use App\Models\Image;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = City::factory(5)->create();

        foreach ($cities as $city) {
            Image::factory(1)->cityImage()->create([
                'imageable_id' => $city->id,
                'imageable_type' => City::class
            ]);

            $citiesChildren = City::factory(3)->create([
                'parent_id' => $city->id
            ]);

            foreach ($citiesChildren as $cityChild) {
                Image::factory(1)->cityImage()->create([
                    'imageable_id' => $cityChild->id,
                    'imageable_type' => City::class
                ]);
            }
        }
    }
}
