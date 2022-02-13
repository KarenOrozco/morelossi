<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Image;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::factory(5)->create();

        foreach ($categories as $category) {

            Image::factory(1)->categoryImage()->create([
                'imageable_id' => $category->id,
                'imageable_type' => Category::class
            ]);

            $categoriesChildren = Category::factory(2)->create([
                'parent_id' => $category->id,
            ]);

            foreach ($categoriesChildren as $categoryChild) {
                Image::factory(1)->categoryImage()->create([
                    'imageable_id' => $categoryChild->id,
                    'imageable_type' => Category::class
                ]);

                $categoriesChildren2 = Category::factory(2)->create([
                    'parent_id' => $categoryChild->id,
                ]);

                foreach ($categoriesChildren2 as $categoryChild2) {
                    Image::factory(1)->categoryImage()->create([
                        'imageable_id' => $categoryChild2->id,
                        'imageable_type' => Category::class
                    ]);
    
                }
            }
        }
    }
}
