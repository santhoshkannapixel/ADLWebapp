<?php

namespace App\Mail;

use App\Models\NewsLetter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsLetterMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('mail.news_letter')->with('details', $this->details);
        return $this->from('noreplay@gmail.com')->markdown('mail.news_letter')->with('details', $this->details);;

    }
}
