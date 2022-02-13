<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Image;
use App\Models\Location;
use App\Models\Phone;
use App\Models\SocialNetwork;
use App\Models\User;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory(20)->create([
            'type' => 2
        ]);
        $companies = [];

        foreach ($users as $user) {
            Image::factory(1)->userImage()->create([
                'imageable_id' => $user->id,
                'imageable_type' => User::class
            ]);

            $company = Company::factory()->create([
                'user_id' => $user->id
            ]);

            array_push($companies,$company);
        }
        
        foreach ($companies as $company) {
            Image::factory(3)->companyImage(3)->create([
                'imageable_id' => $company->id,
                'imageable_type' => Company::class
            ]);

            Location::factory(1)->create([
                'company_id' => $company->id
            ]);
            
            Phone::factory(3)->create([
                'company_id' => $company->id
            ]);

            SocialNetwork::factory(3)->create([
                'company_id' => $company->id
            ]);

            $company->categories()->attach([
                rand(6, 15),
                rand(6, 15)
            ]);

            $company->workSchedules()->attach([
                rand(1, 10),
                rand(1, 10)
            ]);
        }
    }
}
