<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Order;

class SendNewMail extends Mailable
{
    use Queueable, SerializesModels;
    

    public $test;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {   
        $this->test = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        return $this->view('mail.mailtemplate');
    }
}