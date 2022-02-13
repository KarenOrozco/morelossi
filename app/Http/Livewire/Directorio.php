<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class Directorio extends Component
{

    public $categories, $city, $search;

    use WithPagination;

    public function render()
    {        
        return view('livewire.directorio');
    }
}
