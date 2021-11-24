<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ActionReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $action;



    public $deleteWhenMissingModels = true;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mob, $activity, $action)
    {
      $this->mob = $mob;
      $this->activity = $activity;
      $this->action = $action;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.action-reminder');
    }
}
