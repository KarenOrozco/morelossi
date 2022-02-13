<?php

namespace App\Http\Livewire\Dashboard\Users;

use App\Mail\UserRegisterMailable;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    public $search, $show = '10', $password;
    public $open_edit;
    public $user, $rol, $roles;

    use WithPagination;

    protected $queryString = [
        'show' => ['except' => '10'],
        'search' => ['except' => '']
    ];

    protected $listeners = [
        'delete-user' => 'delete'
    ];

    protected $rules = [
        'user.name' => 'required',
        'user.email' => 'required|email',
        'rol' => 'required'
    ];

    protected $messagesValidation = [
        'user.name.required' => 'El nombre del usuario es requerido',
        'user.email.required' => 'El email del usuario es requerido',
        'user.email.unique' => 'Ya existe un registro con este correo. Intente con otro',
        'rol.required' => 'El rol del usuario es requerido',
    ];

    public $form = [
        'title' => null,
        'action' => null,
        'actionButton' => null,
    ];

    public function mount() {
        $this->open_edit = false;
        $this->roles = Role::all();
        // $this->show = '2';
    }

    public function updatingSearch() {
        $this->resetPage();
    }

    public function render() {
        $users = User::where('type',1)
                        ->where(function($query) {
                            $query->orWhere('name', 'like', '%' . $this->search . '%')
                                    ->orWhere('email', 'like', '%' . $this->search . '%');
                        })                        
                        ->paginate($this->show);

        return view('livewire.dashboard.users.index', compact('users'));
    }

    public function create() {
        $this->open_edit = true;
        $this->user = new User();

        $this->form['title'] = 'Crear usuario';
        $this->form['action'] = 'save';
        $this->form['actionButton'] = 'Guardar';
    }

    public function edit(User $user) {
        $this->open_edit = true;
        $this->user = $user;
        $rol = $this->user->roles->first();
        if(!empty($rol)){
            $this->rol = $rol->id;
        }

        $this->form['title'] = 'Editar usuario';
        $this->form['action'] = 'update';
        $this->form['actionButton'] = 'Actualizar';
    }

    public function update() {
        $this->validate([
            'user.name' => 'required',
            'user.email' => 'required|email|unique:users,email,'.$this->user->id,
            'rol' => 'required'
        ], $this->messagesValidation);
        // $this->validate($this->rules, $this->messagesValidation);
        // $this->user->roles()->sync($this->rol);
		
		$this->assignRole($this->user, $this->rol);
        $this->user->save();

        $this->reset(['open_edit']);
        $this->emit('alert', 'El usuario se actualizó satisfactoriamente');
    }

    public function assignRole(User $user, $value) {
        switch ($value) {
            case '1':
                $user->assignRole('admin');
                $user->removeRole('afiliado');
                break;
            
            case '2':
                $user->assignRole('afiliado');
                $user->removeRole('admin');
                    break;

            default:
                # code...
                break;
        }

        return $user;
    }

    public function save() {

        $this->validate([
            'user.name' => 'required',
            'user.email' => 'required|email|unique:users,email',
            'rol' => 'required'
        ], $this->messagesValidation);

        // $this->validate($this->rules, $this->messagesValidation);

        $password = $this->random_password();
        $this->password = $password;
        $this->user->password = bcrypt($password);
        // $this->user->roles()->sync($this->rol);
		$this->assignRole($this->user, $this->rol);
        $this->user->save();

        $correo = new UserRegisterMailable($this->user, $this->password);
        Mail::to($this->user->email)->send($correo);

        $this->reset(['open_edit']);
        $this->emit('alert', 'El usuario se agregó correctamente');
    }

    public function delete(User $user) {
        $user->delete();
    }

    function random_password() {  
        $longitud = 8; // longitud del password  
        $pass = substr(md5(rand()),0,$longitud);
        return $pass; // devuelve el password
    }
}
