<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Payment;

class IborDonations extends Mailable
{
    use Queueable, SerializesModels;

        public $sendmail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Payment $sendmail)
    {
        $this->sendmail = $sendmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Thanks for supporting IBOR')->markdown('emails.iborSupport');
    }
}
