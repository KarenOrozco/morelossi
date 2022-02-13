<?php

namespace App\Mail;

use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StoreStatusAcceptMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Aprobado. Su registro de aficiliación fue aprobado";
    public $store;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Company $store)
    {
        $this->store = $store;

        $date = Carbon::parse($store->created_at);
        $date->locale('es');
        $this->store->dateCreated = $date->format('Y/m/d');
        $this->store->timeCreated = $date->format('h:i A');
        $this->store->createdAtFormat = $date->isoFormat('D [de] MMMM, YYYY [a las] hh:mm A');

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.afiliation-status-accept');
    }
}
