<?php

namespace App\Http\Livewire\Categories;

use App\Models\Category;
use App\Models\City;
use App\Models\Company;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\WithPagination;

class Show extends Component
{

    use WithPagination;

    public $category, $categoriaHija, $rootCategories;
    public $cities, $city, $banners;
    public $search;
    public $stores = [];
    public $category_ids;

    // protected $queryString = [
    //     'city' => ['except' => 'all'],
    //     'search' => ['except' => ''],
    // ];

    protected $rules = [
        'category.slug' => '',
        'city.slug' => '',
    ];

    public function mount() {
        $this->cities = City::where('parent_id',null)->get();
        $this->rootCategories = Category::where('parent_id',null)->get();
        $banners = $this->category->images;
        $this->banners = [];
        foreach ($banners as $item) {
            array_push($this->banners, $item->url);
        }


        // if($this->city === 'all'){
        //     $this->city = null;
        // }else{
        //     $this->city = City::where('slug',$this->city)->first();
        // }
        // $stores = [];
        // $this->stores = $this->storesToCategory($this->category, $stores);
    }

    public function render()
    {
        $categories = Category::where('parent_id', $this->category->id)->paginate(4);




        // $stores = [];
        // $this->stores = $this->storesToCategory($this->category, $stores);

        // $storesWithPagination = $this->customPagination($this->stores);
        //$storesWithPagination = collect($storesWithPagination);

        // $storesWithPagination = $this->getAllCategoriesByCategoryRoot();

        $this->category_ids = $this->category->getDescendants($this->category);  
        $storesQuery = Company::query()->whereHas('categories', function(Builder $query) {
            $query->whereIn('categories.id', $this->category_ids );
        })->where('status',4);

        if ($this->categoriaHija) {
            $category = Category::query()->where('name',$this->categoriaHija)->first();
            $this->category_ids = $category->getDescendants($category);  
            $storesQuery = Company::query()->whereHas('categories', function(Builder $query) {
                $query->whereIn('categories.id', $this->category_ids );
            });
        }

        if($this->city){
            $this->cities_ids = $this->city->getDescendants($this->city); 
            $storesQuery = $storesQuery->whereHas('locations', function(Builder $query) {
                $query->whereIn('locations.id', $this->cities_ids );
            });
        }

        if($this->search){
            $storesQuery = $storesQuery->where('name', 'LIKE', '%'.$this->search.'%');
        }

        $storesWithPagination = $storesQuery->orderBy('priority', 'DESC')->paginate(16);


        //Company::query()->whereHas('categories.allChildrenCategories');

        // $storesWithPagination = Company::query()->whereHas('categories.allChildrenCategories', function(Builder $query) use($category_ids) {
        //     $query->whereIn('categories.id', $category_ids);
        // });


       // $storesWithPagination = $this->category->with('allChildrenCategories');

        //$storesWithPagination = $storesWithPagination->allChildrenCategories();


        // $storesWithPagination = Company::query()->whereHas('categories', function(Builder $query) {
        //     $query->whereHas('allChildrenCategories', function(Builder $query) {
        //         $query->where('categories.id', $this->category->id);
        //     });
        // });

        // foreach ($this->category->categories as $key => $subcategory) {
        //     $storesWithPagination = $storesWithPagination->whereHas('categories.allChildrenCategories', function(Builder $query) {
        //     });
        // }
        
        //$storesWithPagination =  $storesWithPagination->paginate(4);
        return view('livewire.categories.show', compact('storesWithPagination','categories'));
    }

    public function customPagination($stores){
        $pageName = 'page';
        $perPage = 2;
        $page = Paginator::resolveCurrentPage($pageName);

        $offSet = ($page * $perPage) - $perPage;  
        $itemsForCurrentPage = array_slice($stores, $offSet, $perPage, true);  

        $storesList =  new LengthAwarePaginator($itemsForCurrentPage, count($stores), $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => $pageName,
        ]);

        return $storesList;
    }

    public function storesToCategory(Category $category, $stores){
        if(count($category->categories)){
            foreach ($category->categories as $key => $categoryChild) {

                // $companies = $categoryChild->companies()->where('status',4)->get();

                $companies = $categoryChild->companies()->get();

                foreach ($companies as $key => $company) {
                    array_push($stores, $company);
                }
                $this->storesToCategory($categoryChild, $stores);
            }
        }

        return $stores;
    }

    public function getAllCategoriesByCategoryRoot() {

        $storesWithPagination = Company::query()->whereHas('categories', function(Builder $query){
            $query->where('parent_root_id', $this->category->id);
        });

        if ($this->categoriaHija) {
            $storesWithPagination = $storesWithPagination->whereHas('categories',function(Builder $query){
                $query->where('name', $this->categoriaHija);
            });
        }

        return $storesWithPagination->paginate();

    }

    public function getSubcategories(Category $category, $storesWithPagination) {

        // if($category->parent === null){
        //     $storesWithPagination = Company::query()->whereHas('categories', function(Builder $query) use($category){
        //         $query->where('parent_id', $category->id);
        //     });
        // }else{
            
        // }
        
        // if(count($category->categories)){
        //     $this->getSubcategories($category, $storesWithPagination);
        // }

        // if(count($category->categories)){
            foreach ($category->categories as $subcategory) {
                $storesWithPagination = $storesWithPagination->whereHas('categories', function(Builder $query) use($subcategory){
                    $query->whereHas('categories', function(Builder $query) use($subcategory){
                        $query->orWhere('parent_id',$subcategory->id);
                    });
                    
                    // orWhere('categories.id',$subcategory->id);
                });
                $this->getSubcategories($subcategory, $storesWithPagination);
            }
        // }

        return $storesWithPagination;
    }

    public function clean(){
        $this->resetPage();
        $this->reset(['categoriaHija']);
    }

}
