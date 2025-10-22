<?php

namespace App\Mail;

use App\Models\ContactBook;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewContactRegisteredMail extends Mailable
{
    use Queueable, SerializesModels;

    private ContactBook $contactBook;

    /**
     * Create a new message instance.
     */
    public function __construct(ContactBook $contactBook) {
        $this->contactBook = $contactBook;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Novo Contato Cadastrado',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.new-contact-registered',
            with: [
                'contact_name' => $this->contactBook->contact_name,
                'contact_phone' => $this->contactBook->contact_phone,
                'contact_email' => $this->contactBook->contact_email,
            ]
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
