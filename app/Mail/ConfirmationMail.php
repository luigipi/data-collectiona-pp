<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Iborseminar;

class ConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $sendMail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Iborseminar $sendMail)
    {
        $this->sendMail = $sendMail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->subject('Thank you for registering for IBOR 7')->markdown('emails.seminar');
    }
}
