<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;

class NewsletterMail extends Mailable
{
    use Queueable, SerializesModels;
    public $content;
    public $image;

    /**
     * Create a new message instance.
     */
    public function __construct($mailData)
    {
        $this->content = $mailData['message'];
        $this->image = $mailData['image'] ?? null;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Newsletter',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.newsletter',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        
        $attachments = [];

        // Se uma imagem foi carregada, anexe ao e-mail
        if ($this->image) {
            $attachments[] = Attachment::fromStorageDisk('public', $this->image)
                ->as('newsletter-image.jpg')
                ->withMime('image/jpeg');
        }

        return $attachments;
    }
}
