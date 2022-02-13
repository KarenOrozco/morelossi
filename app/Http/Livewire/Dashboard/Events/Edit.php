<?php

namespace App\Http\Livewire\Dashboard\Events;

use App\Models\Event;
use App\Models\Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;

class Edit extends Component
{
    public $event, $slug, $start_time, $finish_time;

    protected $listeners = [
        'refreshEvent',
    ];

    protected $rules = [
        'event.name' => 'required',
        'slug' => 'required',
        'event.description' => 'required',
        'start_time' => 'required|date_format:Y-m-d\TH:i',
        'finish_time' => 'required|date_format:Y-m-d\TH:i|after:start_time',
    ];

    protected $messagesValidation = [
        'event.name.required' => 'El nombre de la tienda es requerido',
        'slug.required' => 'El slug requerido',
        'event.description.required' => 'La descripción es requerida',
        'start_time.required' => 'La fecha es requerida',
        'finish_time.required' => 'La fecha es requerida',
        'finish_time.after' => 'La fecha debe ser posterior a la fecha de inicio',
    ];

    public $form = [
        'title' => null,
        'action' => null,
        'actionButton' => null,
    ];
    
    public function mount(Event $event){
        $this->event = $event;

        $this->slug = $this->event->slug;
        $this->start_time = Carbon::parse($this->event->start_time)->format('Y-m-d\TH:i');
        $this->finish_time = Carbon::parse($this->event->finish_time)->format('Y-m-d\TH:i');

        $this->form['title'] = 'Editar evento';
        $this->form['action'] = 'update';
        $this->form['actionButton'] = 'Actualizar';
    }

    public function update() {

        $this->validate($this->rules, $this->messagesValidation);

        $this->event->slug = $this->slug;
        $this->event->start_time = $this->start_time;
        $this->event->finish_time = $this->finish_time;

        $this->event->save();
        
        $this->emitTo('dashboard.events.index','render-show-events');
        $this->emit('alert', 'El evento se actualizó satisfactoriamente');

    }

    public function render()
    {
        $header = '';
        return view('livewire.dashboard.events.edit')->layout('layouts.dashboard', compact('header'));
    }

    public function refreshEvent(){
        $this->event = $this->event->fresh();
    }

    public function deleteBanner(Image $banner) {
        Storage::delete([$banner->url]);
        $banner->delete();

        $this->event = $this->event->fresh();
    }

    public function updatedEventName($value){
        $this->slug = Str::slug($value);
    }
}
