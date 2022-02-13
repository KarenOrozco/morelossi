<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Slideshow extends Component
{
    public $activeSlide = 1;
    public $slides = [1,2,3];

    public function render()
    {
        return view('livewire.slideshow');
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
