<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\City;
use App\Models\Company;
use Livewire\Component;

class Search extends Component
{

    public $search, $city, $cities, $category, $categories;

    public $open = false;

    public function mount(){
        $this->categories = Category::where('parent_id',null)->get();
        $this->cities = City::where('parent_id',null)->get();
    }

    public function updatedSearch($value){
        if ($value) {
            $this->open = true;
        }else{
            $this->open = false;
        }
    }

    public function updatedCityId(){
        // $this->emitTo('directorio','render');
    }

    public function render()
    {
        if ($this->search) {
            $stores = Company::where('name', 'LIKE' ,'%' . $this->search . '%')
                                ->where('status', 4)
                                ->take(8)
                                ->get();
        } else {
            $stores = [];
        }
        return view('livewire.search', compact('stores'));
    }
}
