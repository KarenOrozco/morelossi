<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Livewire\Component;

class Events extends Component
{

    public $eventsCalendar = [];
    public $events;
    
    public function mount(){
        $this->open_edit = false;
        foreach ($this->events as $key => $item) {

            array_push($this->eventsCalendar, [
                'event_title' => $item->name,
                'event_date' => $item->start_time,
                'event_theme' => $item->color
            ]);
        }

    }

    public function render()
    {
       
        return view('livewire.events');
    }

}
