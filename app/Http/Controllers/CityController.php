<?php

namespace App\Http\Controllers;

use App\Models\City;

class CityController extends Controller
{
    public function index() {
        $cities = City::All();

        return view('cities.index', compact('cities'));
    }

   
    public function showBySlug($citySlug)
    {
        $city = City::where('slug','LIKE', '%'.$citySlug.'%')->first();

        return view('cities.show', compact('city'));
    }

}
