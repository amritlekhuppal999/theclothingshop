<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use Illuminate\Mail\Mailables\Address;      // ADDED

class EmailVerificationCode extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $verificationCode;
    
    /*** Create a new message instance.*/
    public function __construct($mailingData)
    {
        $this->name = $mailingData["name"];
        $this->verificationCode = $mailingData["verificationCode"];
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('mail@theClothingShop.com', env('APP_NAME')),
            replyTo: [
                new Address('mail@theClothingShop.com', env('APP_NAME')),
            ],
            subject: 'Your Email Verivication Code',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        
        // specifies the blade view, you wish to use that will host the email body/content

        return new Content(
            view: 'mail.email-verification',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
