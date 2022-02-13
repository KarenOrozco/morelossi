<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Company;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Mail\StoreStatusAcceptMailable;
use App\Mail\StoreStatusMailable;
use App\Mail\StoreStatusRefuseMailable;
use Illuminate\Support\Facades\Mail;

class Index extends Component
{
    public $search, $show = '10', $status = [], $index = 0;
    public $open_edit, $open_email_modal;
    public $loadedData = false;
    public $store, $storeMessage, $user, $message;
    public $workSchedules;
    use WithPagination;

    protected $listeners = [
        'refuse-store' => 'refuse',
        'accept-store' => 'approve'
    ];

    protected $queryString = [
        'show' => ['except' => '10'],
        'search' => ['except' => '']
    ];

    public $form = [
        'title' => null,
        'action' => null,
        'actionButton' => null,
    ];

    protected $rules = [
        'store.name' => 'required',
        'store.slug' => 'required',
        'store.description' => 'required',
        'user.email' => 'required|email|unique:users,email',
    ];

    public function updatingShow() {
        $this->resetPage();
    }

    public function updatingSearch() {
        $this->resetPage();
    }

    public function updatedIndex() {
        switch ($this->index) {
            case 0:
                $this->status = [1,3,5];
                break;
            case 1:
                $this->status = [2];
                break;
            case 2:
                $this->status = [4];
                break;
            default:
                # code...
                break;
        }
    }

    public function mount() {
        $this->updatedIndex();
        $this->open_email_modal = false;
        $this->storeMessage = new Company();
    }

    public function render() {
        //status
        // 1 -> pendiente 2 -> aprobado 3 -> requiere cambios 4 -> rechazado 5 -> cambios pendientes de aceptar
        // $stores = Company::where('status', $this->status+1)
        //                     ->where(function($query) {
        //                         $query->where('description', 'like', '%' . $this->search . '%')
        //                         ->orWhere('name', 'like', '%' . $this->search . '%');
        //                     })
        //                     // ->orWhere('description', 'like', '%' . $this->search . '%')
        //                     // ->orWhere('name', 'like', '%' . $this->search . '%')
        //                     ->orderBy('id', 'DESC')          
        //                     ->paginate($this->show);

        $this->loadedData = false;
        $stores = $this->loadDashboard();
        return view('livewire.dashboard.index', compact('stores'));
    }

    public function getStatus() {
        switch ($this->storeMessage->status) {
            case 1:
                $this->storeMessage->statusDescription = 'Pendiente';
                break;
            case 2:
                $this->storeMessage->statusDescription = 'Aprobado';
                break;
            case 3:
                $this->storeMessage->statusDescription = 'Requiere cambios';
                break;
            case 4:
                $this->storeMessage->statusDescription = 'Rechazado';
                break;
            case 5:
                $this->storeMessage->statusDescription = 'Cambios pendientes de revisar';
                break;
            default:
                # code...
                break;
        }
    }

    public function loadDashboard() {
        $stores = Company::whereIn('status', $this->status)
                            ->where(function($query) {
                                $query->where('description', 'like', '%' . $this->search . '%')
                                ->orWhere('name', 'like', '%' . $this->search . '%');
                            })
                            // ->orWhere('description', 'like', '%' . $this->search . '%')
                            // ->orWhere('name', 'like', '%' . $this->search . '%')
                            ->orderBy('id', 'DESC')          
                            ->paginate($this->show);
        $this->loadedData = true;
        return $stores;
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

        if(!isset($this->workSchedules[$day])) {
            $this->workSchedules[$day] = [
                'dayNumber' => $day,
                'dayName' => $dayName,
                'schedules' => [],
            ];
        }            
        array_push($this->workSchedules[$day]['schedules'],$schedules);
        
    }

    public function approve($storeId) {
        $store = Company::find($storeId);
        $store->status = 2;
        $store->save();

        $correo = new StoreStatusAcceptMailable($store);
        Mail::to($store->user->email)->send($correo);

    }

    public function refuse($storeId) {
        $store = Company::find($storeId);
        $store->status = 4;
        $store->save();

        $correo = new StoreStatusRefuseMailable($store);
        Mail::to($store->user->email)->send($correo);
    }
 
    public function waitingChanges() {
        $this->storeMessage->status = 5;
        $this->storeMessage->save();

        $this->reset(['open_email_modal']);

        $correo = new StoreStatusMailable($this->storeMessage, $this->message);
        Mail::to($this->storeMessage->user->email)->send($correo);

        $this->storeMessage = new Company();
        $this->reset(['message']);
        

        $this->emit('alert', 'Se ha cambiado el status del negocio.
                            Solicitud de cambios enviada por correo');
    }

    public function requestChanges($storeId) {
        $this->open_email_modal = true;
        $this->storeMessage = Company::find($storeId);
        $this->getStatus();

        $this->form['title'] = 'Redacción de correo';
        $this->form['action'] = 'waitingChanges';
        $this->form['actionButton'] = 'Enviar solicitud de cambios';
    }
}
