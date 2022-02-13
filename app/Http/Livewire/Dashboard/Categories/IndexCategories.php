<?php

namespace App\Http\Livewire\Dashboard\Categories;

use Livewire\Component;
use App\Models\Category;

class IndexCategories extends Component
{
    public $headings = [];
    public $search;

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
    }

    public function render()
    {
        $categories = Category::where('parent_id',null)
        ->where('name','LIKE', '%' .$this->search. '%')
        ->paginate();

        return view('livewire.dashboard.categories.index-categories', compact('categories'));
    }
}
