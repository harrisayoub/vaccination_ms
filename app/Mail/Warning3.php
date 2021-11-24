<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Warning3 extends Mailable
{
    use Queueable, SerializesModels;

    public $mob;

    public $deleteWhenMissingModels = true;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mob)
    {
        $this->mob = $mob;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.warning-3');
    }
}
