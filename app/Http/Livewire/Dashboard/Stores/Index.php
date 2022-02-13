<?php

namespace App\Http\Livewire\Dashboard\Stores;

use App\Models\Company;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Index extends Component
{
    public $search, $show = '10', $password;
    public $open_edit;
    public $store, $user;
    public $workSchedules;

    use WithPagination;

    protected $queryString = [
        'show' => ['except' => '10'],
        'search' => ['except' => '']
    ];

    protected $listeners = [
        'delete-store' => 'delete',
    ];

    protected $rules = [
        'store.name' => 'required',
        'store.slug' => 'required',
        'store.description' => 'required',
        'user.email' => 'required|email|unique:users,email'
    ];

    protected $messagesValidation = [
        'store.name.required' => 'El nombre de la tienda es requerido',
        'store.slug.required' => 'El slug requerido',
        'store.description.required' => 'La descripción es requerida',
        'user.email.required' => 'El email de contacto es requerido',
        'user.email.unique' => 'El email proporcionado ya se encuentra regitrado para otro negocio, proporciona otro',
    ];

    public $form = [
        'title' => null,
        'action' => null,
        'actionButton' => null,
    ];

    public function mount() {
        $this->open_edit = false;
        $this->user = new User();
    }

    public function updatingShow() {
        $this->resetPage();
    }

    public function updatingSearch() {
        $this->resetPage();
    }

    public function updatedStoreName($value) {
        $this->store->slug = Str::slug($value);
    }

    public function render() {
        $stores = Company::where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('description', 'like', '%' . $this->search . '%')
                            ->orderBy('id', 'DESC')          
                            ->paginate($this->show);

        return view('livewire.dashboard.stores.index', compact('stores'));
    }

    public function create() {
        $this->open_edit = true;
        $this->store = new Company();
        $this->user = new User();

        $this->form['title'] = 'Crear usuario';
        $this->form['action'] = 'save';
        $this->form['actionButton'] = 'Guardar';
    }

    public function edit($store) {
        $this->store = Company::find($store);
        $this->user = new User();
        $this->user->email = $this->store->user->email;
        $this->open_edit = true;

        $this->form['title'] = 'Editar usuario';
        $this->form['action'] = 'update';
        $this->form['actionButton'] = 'Actualizar';
    }

    public function update() {
        $this->validate($this->rules, $this->messagesValidation);
        $this->store->save();

        $this->reset(['open_edit']);
        $this->emit('alert', 'El negocio se actualizó satisfactoriamente');
    }

    public function save() {
        $this->validate($this->rules, $this->messagesValidation);
        

        $this->user->name = $this->store->name;
        $this->user->password = $this->random_password();
        $this->type = 2;
        $this->user->save();

        $this->store->user_id = $this->user->id;
        $this->store->save();

        $this->reset(['open_edit','user']);
        $this->emit('alert', 'El negocio se agregó correctamente');
    }

    public function delete(Company $store) {
        $store->delete();
    }

    public function show($store) {
        $this->open_edit = true;
        $this->store = Company::find($store);
        $this->user = new User();
        $this->user->email = $this->store->user->email;
        $this->getSchedules();

        $this->form['title'] = '';
        $this->form['action'] = 'show';
        $this->form['actionButton'] = 'OK';
    }

    function random_password() {  
        $longitud = 8; // longitud del password  
        $pass = substr(md5(rand()),0,$longitud);
        return $pass; // devuelve el password
    }

    public function getSchedules() {
        $this->workSchedules = [];
        if ($this->store !== null) {
            $wschedules =  $this->store->workSchedules;
       
            foreach ($wschedules as $key => $value) {
                $schedules = [
                    'startTime' => $value->start_time,
                    'finishTime' => $value->finish_time,
                    'id' => $value->id,
                ];
                $this->getWorkShedulesList($value->day, $schedules);
            }
        }
    }

    public function getWorkShedulesList($day, $schedules) {
        switch ($day) {
            case 1:
                $dayName = 'Lunes';
                break;
            case 2:
                $dayName = 'Martes';
                break;
            case 3:
                $dayName = 'Miércoles';
                break;
            case 4:
                $dayName = 'Jueves';
                break;
            case 5:
                $dayName = 'Viernes';
                break;
            case 6:
                $dayName = 'Sábado';
                break;
            case 7:
                $dayName = 'Domingo';
                break;
            default:
                # code...
                break;
        }

        if(!isset($this->workSchedules[$day])){
            $this->workSchedules[$day] = [
                'dayNumber' => $day,
                'dayName' => $dayName,
                'schedules' => [],
            ];
        }            
        array_push($this->workSchedules[$day]['schedules'],$schedules);
        
    }
}
