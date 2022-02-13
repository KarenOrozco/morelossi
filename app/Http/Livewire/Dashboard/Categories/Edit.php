<?php

namespace App\Http\Livewire\Dashboard\Categories;

use Livewire\Component;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Edit extends Component
{
    // public $open = false;
    public $categories =[];
    public $category, $type, $categoryId, $slug;

    protected $listeners = [
        'refreshCategory',
    ];

    protected $rules = [
        'category.name' => 'required',
        'slug' => 'required',
    ];

    protected $messagesValidation = [
        'category.name.required' => 'El nombre de la categoria es requerido',
        'slug.required' => 'El slug de la categoria es requerido',
        'type.required' => 'El tipo de categoria es requerido',
        'type.numeric' => 'El tipo de categoria es numérico',
        'type.in' => 'El tipo de categoria no es valido, selecciona uno nuevamente',
        'categoryId.required' => 'La categoria padre es requerida para la subcategoria',
        'categoryId.numeric' => 'Selecciona una categoria',
        'categoryId.min' => 'Selecciona una categoria',
    ];

    public $form = [
        'title' => null,
        'action' => null,
        'actionButton' => null,
    ];
    
    public function mount(Category $category){
        $this->category = $category;
        $this->categories = Category::All();
        $this->slug = $this->category->slug;
        
        if($this->category->parent_id === null){
            $this->type = "1";
        }else{
            $this->type = "2";
            $this->categoryId = $this->category->parent_id;
        }

        $this->form['title'] = 'Editar categoria';
        $this->form['action'] = 'update';
        $this->form['actionButton'] = 'Actualizar';
    }

    public function update() {

        if($this->type === '1'){
            $this->categoryId = null;
        }else{
            $this->rules['categoryId'] = 'required|numeric|min:1';
        }

        $this->validate($this->rules, $this->messagesValidation);

        $this->category->parent_id = $this->categoryId;
        $this->category->slug = $this->slug;
        $this->category->save();
        

        // $this->reset(['open']);
        $this->emitTo('dashboard.categories.index','render-show-categories');
        $this->emit('alert', 'La categoría se actualizó satisfactoriamente');

        // redirect(route('dashboard.categories.edit', $this->category));
    }

    public function render()
    {
        $header = '';
        return view('livewire.dashboard.categories.edit')->layout('layouts.dashboard', compact('header'));
    }

    public function refreshCategory(){
        $this->category = $this->category->fresh();
    }

    public function deleteBanner(Image $banner) {
        Storage::delete([$banner->url]);
        $banner->delete();

        $this->category = $this->category->fresh();
    }

    public function updatedCategoryName($value){
        $this->slug = Str::slug($value);
    }
}
