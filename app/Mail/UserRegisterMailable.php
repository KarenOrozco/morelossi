<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegisterMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $subject = "MorelosSí. Datos de acceso";
    public $user;
    public $key;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user,$key)
    {
        $this->user = $user;
        $this->key = $key;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.user-register');
    }
}
