<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Livewire\Component;
use Illuminate\Support\Carbon;

class Calendar extends Component
{

    public $eventsCalendar;
    public $open_edit;
    public $event;

    public $form = [
        'title' => null,
        'action' => null,
        'actionButton' => null,
    ];

    protected $listeners = [
        'show-event' => 'show',
    ];

    protected $rules = [
        'event.name' => 'required',
        'event.slug' => 'required',
        'event.description' => 'required',
        'event.startTime' => 'required',
        'event.finishTime' => 'required'
    ];

    public function mount(){
        $this->eventsCalendar = [];
        $events = Event::All();

        foreach ($events as $key => $item) {
            $date = Carbon::parse($item->start_time);
            array_push($this->eventsCalendar, [
                'event_id' => $item->id,
                'event_title' => $item->name,
                'event_date' => $date->format('Y/m/d'),
                'event_time' => $date->format('h:i A'),
                'event_theme' => $item->color
            ]);
        }
    }

    public function render()
    {
        return view('livewire.calendar');
    }
    
    public function show($event) {
        $this->open_edit = true;
        $this->event = Event::find($event);

        $date = Carbon::parse($this->event->start_time);
        $date->locale('es');
        $this->event->startTimeFormat = $date->isoFormat('D [de] MMMM, YYYY [a las] hh:mm A');

        $this->form['title'] = '';
        $this->form['action'] = 'show';
        $this->form['actionButton'] = 'OK';
    }
}
