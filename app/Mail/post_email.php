<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class post_email extends Mailable
{
    use Queueable, SerializesModels;

    public $email_sender;
    public $name_sender;
    public $subject;

    /**
     * Create a new message instance.
     */
    public function __construct(string $email_sender, string $name_sender, string $subject)
    {
        $this->email_sender = $email_sender;
        $this->name_sender = $name_sender;
        $this->subject = $subject;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->email_sender, $this->name_sender),
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.index',
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
