<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageToUser extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Tu Canje de Productos';

    public $exchange;
    public $user;
    public $products;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($exchange, $user, $products)
    {
        $this->exchange = $exchange;
        $this->user = $user;
        $this->products = $products;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.message-to-user');
    }
}
