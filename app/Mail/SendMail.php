<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($url)
    {
        //
        $this -> url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {//env('PLAGIARISM_APIURL')
        $email_address = env('APP_SUPPORT_EMAIL');
        $email_reply_address = env('APP_SUPPORT_EMAIL');
        return $this -> from($email_address)
                     -> replyTo($email_reply_address)
                     -> subject('PlagiarismChecker Result')
                     -> view(['html' => 'email', 'text' => 'email_text'])
                     -> with(['url' => $this->url]);
                     // -> AddEmbeddedImage(asset('images/logo_email.png'),'logo_email');
    }
}
