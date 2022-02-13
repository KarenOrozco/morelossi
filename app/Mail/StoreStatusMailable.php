<?php

namespace App\Mail;

use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StoreStatusMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Status de su registro de afiliación";
    public $store, $slot;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Company $store, $slot)
    {
        $this->store = $store;
        $this->slot = $slot;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.afiliation-status');
    }
}
