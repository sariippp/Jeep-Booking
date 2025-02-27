<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactForm extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Pesan Baru dari Form Kontak Website: ' . $this->data['subject'])
                    ->view('emails.contact')
                    ->with([
                        'name' => $this->data['name'],
                        'email' => $this->data['email'],
                        'subject' => $this->data['subject'],
                        'message_content' => $this->data['message'],
                    ]);
    }
}