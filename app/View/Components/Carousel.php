<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Carousel extends Component
{
    public $activeSlide;
    public $slides;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->activeSlide = 1;
        $this->slides = [1,2,3,4,5];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.carousel');
    }

    public function setActiveSlide($slide) {
        $this->activeSlide = $slide;
    }

    public function previousSlide() {
        
        if ($this->activeSlide === 1) {
            $this->activeSlide = count($this->slides);
        }else{
            $this->activeSlide = $this->activeSlide - 1;
        }
        return $this->activeSlide;
    }

    public function nextSlide() {
        if ($this->activeSlide === count($this->slides)) {
            $this->activeSlide = 1;
        }else{
            $this->activeSlide = $this->activeSlide + 1;
        }
        echo "----";
        return $this->activeSlide;
    }

    public function color($slide) {
        if ($this->activeSlide === $slide) {
            return true;
        }
        return false;
    }

    public function colori($slide) {
        if ($this->activeSlide !== $slide) {
            return true;
        }
        return false;
    }
}
