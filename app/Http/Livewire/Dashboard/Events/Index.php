<?php

namespace App\Http\Livewire\Dashboard\Events;

use App\Models\Event;
use DateTimeZone;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class Index extends Component
{

    // 7f81e453

    public $search, $show = '10';
    public $open_edit;
    public $event;
    public $eventsCalendar;
    public $vieww = "calendar";

    use WithPagination;

    protected $queryString = [
        'show' => ['except' => '10'],
        'search' => ['except' => '']
    ];

    protected $listeners = [
        'show-event' => 'show',
        'delete-event' => 'delete',
        'render-show-events' => 'render',
        'render-show-calendar-events' => 'updateEventInCalendar',
    ];

    protected $rules = [
        'event.name' => 'required',
        'event.slug' => 'required',
        'event.description' => 'required',
        'event.startTime' => 'required',
        'event.finishTime' => 'required'
    ];

    protected $messagesValidation = [
        'store.name.required' => 'El nombre de la tienda es requerido',
        'store.slug.required' => 'El slug requerido',
        'store.description.required' => 'La descripción es requerida',
        'user.startTime.required' => 'La fecha es requerida',
        'user.finishTime.unique' => 'La fecha es requerida',
    ];

    public $form = [
        'title' => null,
        'action' => null,
        'actionButton' => null,
    ];

    public function mount() {
        $this->open_edit = false;
        $this->event = new Event();

        Carbon::setLocale('es');
        $this->eventsCalendar = [];
        $events = Event::All()->sortBy('start_time');
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
        // setlocale(LC_ALL,"es_MX");
        // $fechaFormato = strftime("%A %d %B %Y", strtotime( date('Y-m-d') ));
                  
    }

    public function updatingShow(){
        $this->resetPage();
    }

    public function updatingSearch() {
        $this->resetPage();
    }

    public function updatedStoreName($value){
        $this->event->slug = Str::slug($value);
    }

    public function render()
    {
        $header = '';
        $events = Event::where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('description', 'like', '%' . $this->search . '%')
                            ->orderBy('start_time', 'DESC')          
                            ->paginate($this->show);

        return view('livewire.dashboard.events.index', compact('events'))->layout('layouts.dashboard', compact('header'));
    }

    public function save() {
        $this->validate($this->rules, $this->messagesValidation);

        $this->event->name = $this->store->name;
        $this->event->save();

        $this->reset(['open_edit','user']);
        $this->emit('alert', 'El evento se creo correctamente');
    }

    public function delete($eventId) {
        $event = Event::find($eventId);
        $event->delete();
    }

    public function show($event) {
        $this->open_edit = true;
        $this->event = Event::find($event);

        $this->form['title'] = '';
        $this->form['action'] = 'show';
        $this->form['actionButton'] = 'OK';
    }

    public function updateEventInCalendar($eventId) {
        $event = Event::find($eventId);
        $date = Carbon::parse($event->start_time);
        array_push($this->eventsCalendar, [
            'event_id' => $event->id,
            'event_title' => $event->name,
            'event_date' => $date->format('Y/m/d'),
            'event_time' => $date->format('h:i A'),
            'event_theme' => $event->color
        ]);
    }
    
}
