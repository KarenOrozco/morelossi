<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\City;
use App\Models\Company;
use App\Models\Location;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Directory extends Component
{
    public $search;
    public $filtroPrincipal = 0;
    use WithPagination;

    public function render()
    {
        $filtro = $this->filtroPrincipal();
        $categoriesParent = $filtro['categoriesParent'];
        $categories = $filtro['categories'];
        $companies = $filtro['companies'];
        $cities = $filtro['cities'];

        return view('livewire.directory', compact('categoriesParent','categories','companies','cities'));
    }

    public function index(Category $category = null) {

        $categoryId = null;

        if ($category !== null) {
            $categoryId = $category->id;
            $companies = $category->companies;
        }

        $categories = Category::where('parent_id', $categoryId)
                            ->where('name','LIKE', '%'.$this->search.'%')
                            ->paginate(4);

        if (count($categories) !== 0) {
            return view('livewire.categories.index', compact('categories'));
        }else{
            return view('categories.companies', compact('companies', 'category'));
        } 
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function filtroPrincipal(){

        $categoriesParent = [];
        $categories = [];
        $companies = [];
        $cities = [];

        switch ($this->filtroPrincipal) {
            case 1:
                $categories = Category::where('name','LIKE', '%'.$this->search.'%')
                                    ->paginate(3);
                break;
            case 2:
                $companies = Company::where('name','LIKE', '%'.$this->search.'%')
                                ->paginate(3);
                break;
            case 3:

                $cities = City::where('name','LIKE', '%'.$this->search.'%')
                            ->paginate(3);
                // $search = $this->search;
               
                // $companies = Company::whereHas('locations',function($query) use($search) { 
                //                 $query->whereHas('city',function($query) use($search){
                //                         $query->where('name','LIKE','%'.$search.'%');
                //                     }); 
                //                 })
                //                 ->paginate(3);


                            // Company::whereHas('locations', function($query) use($search){
                            //     $query->whereIn('city_id', function($query) use($search){
                            //         $query->select('id')->from('cities')->where('name','LIKE','%'.$search.'%');
                            //     });
                            // })
                            // ->paginate();
                break;
                        
            default:
                $categoriesParent = Category::where('parent_id', null)
                                        ->where('name','LIKE', '%'.$this->search.'%')
                                        ->paginate(5);

                $categories = Category::where('name','LIKE', '%'.$this->search.'%')
                                    ->paginate(3);

                $companies = Company::where('name','LIKE', '%'.$this->search.'%')
                                ->paginate(3);

                $cities = City::where('name','LIKE', '%'.$this->search.'%')
                            ->paginate(3);
                break;
        }

        return compact('categoriesParent','categories','companies','cities');
    }
}
