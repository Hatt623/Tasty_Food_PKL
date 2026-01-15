<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactReplyMail;
use App\Models\Contact;

class ContactReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    
    public $contact;
    public $reply;

    /**
     * Create a new message instance.
     */
    public function __construct($contact, $reply)
    {
        $this->contact = $contact;
        $this->reply   = $reply;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Reply from Delicacy')->view('emails.contact_reply');
    }

}
