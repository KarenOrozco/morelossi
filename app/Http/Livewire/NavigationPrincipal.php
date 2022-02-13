<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NavigationPrincipal extends Component
{
    public $selected = 'morelossi';

    public function render()
    {
        return view('livewire.navigation-principal');
    }
}
