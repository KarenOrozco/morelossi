<?php

namespace App\Http\Livewire\Emails;

use App\Models\Company;
use Livewire\Component;

class EmailStore extends Component
{
    public $storeMessage, $open_email_modal = false;

    protected $listeners = [
        'open-email-modal' => 'render',
    ];

    public function render($storeId)
    {
        $this->open_email_modal = true;
        $this->storeMessage = Company::find($storeId);

        $this->form['title'] = 'Redacción de correo';
        $this->form['action'] = 'waitingChanges';
        $this->form['actionButton'] = 'Enviar solicitud de cambios';

        return view('livewire.emails.email-store');
    }

    public $form = [
        'title' => null,
        'action' => null,
        'actionButton' => null,
    ];

    public function requestChanges($storeId) {
        $this->open_email_modal = true;
        $this->storeMessage = Company::find($storeId);

        $this->form['title'] = 'Redacción de correo';
        $this->form['action'] = 'waitingChanges';
        $this->form['actionButton'] = 'Enviar solicitud de cambios';
    }
}
