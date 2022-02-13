<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Company;
use Livewire\Component;

class EmailModal extends Component
{
    public $open_email_modal;
    public $storeMessage;

    public $form = [
        'title' => null,
        'action' => null,
        'actionButton' => null,
    ];

    protected $listeners = [
        'open-email-modal' => 'mount',
    ];

    public function mount($storeId) {
        $this->open_email_modal = true;
        $this->storeMessage = Company::find($storeId);

        $this->form['title'] = 'Redacción de correo';
        $this->form['action'] = 'waitingChanges';
        $this->form['actionButton'] = 'Enviar solicitud de cambios';
    }

    public function render()
    {
        return view('livewire.dashboard.email-modal');
    }

    public function requestChanges($storeId) {
        $this->open_email_modal = true;
        $this->storeMessage = Company::find($storeId);

        $this->form['title'] = 'Redacción de correo';
        $this->form['action'] = 'waitingChanges';
        $this->form['actionButton'] = 'Enviar solicitud de cambios';
    }
}
