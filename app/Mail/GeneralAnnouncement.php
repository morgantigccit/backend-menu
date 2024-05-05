<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GeneralAnnouncement extends Mailable
{
    use Queueable, SerializesModels;

    public $subjectText;
    public $messageText;

    public function __construct($subject, $message)
    {
        $this->subjectText = $subject;
        $this->messageText = $message;
    }

    public function build()
    {
        return $this->subject($this->subjectText)
                    ->view('emails.generalannouncement')
                    ->with([
                        'data' => $this->messageText  // Ensure this is a simple string or clearly defined array
                    ]);
    }


}
