<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Grid3 extends Component
{

    public $title;
    public $elements;
    public $content;
    public $slot;
    public $type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $elements, $type, $content=null, $slot=null)
    {
        $this->title = $title;
        $this->elements = $elements;
        $this->type = $type;
        $this->content = $content;
        $this->slot = $slot;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.grid3');
    }
}
