<?php

namespace App\Mail;

use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StoreRegisterMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Hemos recibido su registro de afiliación";
    public $store;
    public $key;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Company $store, $key)
    {
        $this->store = $store;
        $this->key = $key;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.afiliation');
    }
}
