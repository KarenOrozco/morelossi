<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\City;
use App\Models\Company;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class CategoryStores extends Component
{
    public $category, $city, $search;
    public $stores = [];
    public $loadedData = false;
    public $category_ids, $cities_ids;

    protected $listeners = ['render', 'clearStores'];

    public function mount() {
        // $this->stores = [];
    }

    public function loadStores() {

        // $companies = $this->category->companies()->where('status',5)->take(15)->get();
        // foreach ($companies as $key => $company) {
        //     array_push($this->stores, $company);
        // }
        // $this->storesToCategory($this->category);

        $this->category_ids = $this->category->getDescendants($this->category); 
        $storesQuery = Company::query()->whereHas('categories', function(Builder $query) {
            $query->whereIn('categories.id', $this->category_ids );
        })->where('status',2);

        if($this->city){
            $this->cities_ids = $this->city->getDescendants($this->city); 
            $storesQuery = $storesQuery->whereHas('locations', function(Builder $query) {
                $query->whereIn('locations.id', $this->cities_ids );
            });
        }

        if($this->search){
            $storesQuery = $storesQuery->where('name', 'LIKE', '%'.$this->search.'%');
        }

        $this->stores = $storesQuery->take(15)->orderBy('priority', 'DESC')->get();

        $this->loadedData = true;
        if (count($this->stores)) {
            $this->emit('glider',$this->category->id);
        }
    }

    public function render()
    {
        return view('livewire.category-stores');
    }


    public function clearStores() {
        $this->stores = [];
    }

    public function storesToCategory(Category $category){
        if(count($category->categories)){

            foreach ($category->categories as $key => $categoryChild) {

                $companies = $categoryChild->companies()->where('status',4)->take(15)->get();

                foreach ($companies as $key => $company) {
                    array_push($this->stores, $company);
                }
                $this->storesToCategory($categoryChild);
            }
        }
    }
}
