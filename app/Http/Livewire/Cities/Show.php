<?php

namespace App\Http\Livewire\Cities;

use App\Models\City;
use Livewire\Component;

class Show extends Component
{
    public $city;

    public function mount(City $city) {
        $this->city = $city;
    }

    public function render()
    {
        $cities = City::where('parent_id', $this->city->id)->paginate(4);

        return view('livewire.cities.show', compact('cities'));
    }
}
