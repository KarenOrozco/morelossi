<?php

namespace App\Http\Livewire\Dashboard\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Index extends Component
{
    use WithPagination;

    public $headings = [];
    public $search, $show = '10';
    public $open_edit= false, $category, $type, $categoryId, $categoriesSelect;

    protected $queryString = [
        'show' => ['except' => '10'],
        'search' => ['except' => '']
    ];
    
    protected $listeners = [
        'render-show-categories' => 'render',
        'delete-category' => 'delete'
    ];

    protected $rules = [
        'category.name' => 'required',
        'category.slug' => 'required',
    ];

    protected $messagesValidation = [
        'category.name.required' => 'El nombre de la categoria es requerido',
        'category.slug.required' => 'El slug de la categoria es requerido',
        'type.required' => 'El tipo de categoria es requerido',
        'type.numeric' => 'El tipo de categoria es numérico',
        'type.in' => 'El tipo de categoria no es valido, selecciona uno nuevamente',
        'categoryId.required' => 'La categoria padre es requerida para la subcategoria',
        'categoryId.numeric' => 'Selecciona una categoria',
        'categoryId.min' => 'Selecciona una categoria',
    ];

    public function mount() {
        $this->headings = [
            [
                'key' =>'name',
                'value' => 'Categoria'
            ],
            [
                'key' => 'type',
                'value' => 'Tipo'
            ]
        ];
        
        // $this->show = '5';
        $this->category = [];
        $this->getCategories();
    }

    public function render() {
        $categories = [];

        // $storesQuery = Category::query()->whereHas('allChildrenCategories', function(Builder $query) {
        //     $query->whereIn('categories.id', $this->category_ids );
        // })->where('status',4);

        $header = '';

        if(!empty($this->search)){
            $categories = Category::where('name','LIKE', '%' .$this->search. '%')
                                ->with('allChildrenCategories')
                                ->paginate($this->show);
        }else{
            
            $categories = Category::with('allChildrenCategories')
                                ->paginate($this->show);
        }
        
        return view('livewire.dashboard.categories.index',compact('categories'))->layout('layouts.dashboard', compact('header'));
    }
    
    public function getCategories() {
        $this->categoriesSelect = Category::All();
    }

    public function updatedCategoryName($value){
        $this->category->slug = Str::slug($value);
    }

    public function edit($element) {
        $this->category = Category::find($element);
        $this->open_edit = true;

        if($this->category->parent_id === null){
            $this->type = "1";
        }else{
            $this->type = "2";
            $this->categoryId = $this->category->parent_id;
        }
    }

    public function updatingShow() {
        $this->resetPage();
    }

    public function updatingSearch() {
        $this->resetPage();
    }

    public function update() {

        if($this->type === '1'){
            $this->categoryId = null;
        }else{
            $this->rules['categoryId'] = 'required|numeric|min:1';
        }

        $this->validate($this->rules, $this->messagesValidation);

        $this->category->parent_id = $this->categoryId;
        $this->category->save();
        

        $this->reset(['open_edit']);
        $this->emit('alert', 'La categoría se actualizó satisfactoriamente');
    }

    public function delete($categoryId) {
        $category = Category::find($categoryId);
        $category->delete();

        // $this->getCategories();
        // $this->render();
    }

}
