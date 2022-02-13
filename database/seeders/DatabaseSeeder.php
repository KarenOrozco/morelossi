<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use App\Models\WorkShedule;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {  
        Storage::deleteDirectory('companies');
        Storage::deleteDirectory('users');
        Storage::deleteDirectory('categories');
        Storage::deleteDirectory('cities');

        Storage::makeDirectory('companies');
        Storage::makeDirectory('users');
        Storage::makeDirectory('categories');
        Storage::makeDirectory('cities');

        $this->call(RolSeeder::class);

        User::create([
            'name' => 'karen',
            'email' =>  'karen.orozco.sg@gmail.com',
            'password' => bcrypt('korozco1.')
        ])->assignRole('admin');
        WorkShedule::factory(10)->create();
        $this->call(CategorySeeder::class);
        $this->call(CitySeeder::class);
        $this->call(CompanySeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
