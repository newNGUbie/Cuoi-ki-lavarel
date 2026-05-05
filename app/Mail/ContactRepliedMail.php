<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactRepliedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Contact $contact,
        public string $replyMessage,
        public string $status,
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Phản hồi liên hệ từ '.config('app.name'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-replied',
            with: [
                'contact' => $this->contact,
                'replyMessage' => $this->replyMessage,
                'status' => $this->status,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
