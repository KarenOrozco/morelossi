<?php

namespace App\Http\Livewire\Dashboard\Events;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Create extends Component
{
   
    public $open = false;
    public $event;

    use WithFileUploads;

    protected $rules = [
        'event.name' => 'required',
        'event.slug' => 'required',
        'event.description' => 'required',
        'event.start_time' => 'required|date_format:Y-m-d\TH:i',
        'event.finish_time' => 'required|date_format:Y-m-d\TH:i|after:event.start_time',
    ];

    protected $messagesValidation = [
        'event.name.required' => 'El nombre de la tienda es requerido',
        'event.slug.required' => 'El slug requerido',
        'event.description.required' => 'La descripción es requerida',
        'event.start_time.required' => 'La fecha es requerida',
        'event.finish_time.required' => 'La fecha es requerida',
        'event.finish_time.after' => 'La fecha debe ser posterior a la fecha de inicio',
    ];

    public $form = [
        'title' => null,
        'action' => null,
        'actionButton' => null,
    ];


    public function mount() {
        $this->event = new Event();
    }

    public function render()
    {
        return view('livewire.dashboard.events.create');
    }

    public function updatedEventName($value) {
        $this->event->slug = Str::slug($value);
    }

    public function save() {
        
        $this->validate($this->rules, $this->messagesValidation);

        $this->event->save();

        $this->reset(['open']);
        $this->emitTo('dashboard.events.index','render-show-calendar-events',$this->event->id);
        $this->emitTo('dashboard.events.index','render-show-events');
        $this->emit('alert', 'El evento se creo satisfactoriamente');
    }

}
