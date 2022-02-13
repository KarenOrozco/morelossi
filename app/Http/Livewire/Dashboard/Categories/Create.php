<?php

namespace App\Http\Livewire\Dashboard\Categories;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Create extends Component
{
    public $open = false;
    public $categories =[];

    public $name, $slug, $type, $categoryId;

    use WithFileUploads;

    protected $listeners = [
        'update-categories-select' => 'mount',
    ];

    protected $rules = [
        'name' => 'required',
        'slug' => 'required',
        'type' => 'required|numeric|in:1,2',
    ];

    protected $messagesValidation = [
        'name.required' => 'El nombre de la categoria es requerido',
        'slug.required' => 'El slug de la categoria es requerido',
        'type.required' => 'El tipo de categoria es requerido',
        'type.numeric' => 'El tipo de categoria es numérico',
        'type.in' => 'El tipo de categoria no es valido, selecciona uno nuevamente',
        'categoryId.required' => 'La categoria padre es requerida para la subcategoria',
        'categoryId.numeric' => 'Selecciona una categoria',
        'categoryId.min' => 'Selecciona una categoria',
    ];

    public function mount(){

        $this->categories = Category::All();
    }

    public function render()
    {
        return view('livewire.dashboard.categories.create');
    }

    public function updatedName($value){
        $this->slug = Str::slug($value);
    }

    public function save() {

        if($this->type === '1'){
            $this->categoryId = null;
        }else{
            $this->rules['categoryId'] = 'required|numeric|min:1';
        }

        $this->validate($this->rules, $this->messagesValidation);

        Category::create([
            'name' => $this->name,
            'slug' => $this->slug,
            'parent_id' => $this->categoryId
        ]);

        $this->reset(['open','name','slug','type']);
        $this->emitTo('dashboard.categories.index','render-show-categories');
        $this->emit('alert', 'La categoría se creo satisfactoriamente');
        $this->emitSelf('update-categories-select');
    }

    public function saveImages()
    {
        $this->validate([
            'banners.*' => 'image|max:1024', // 1MB Max
        ]);

    }
}
