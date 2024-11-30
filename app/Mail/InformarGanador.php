<?php

namespace App\Mail;

use App\Models\Producto;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InformarGanador extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Producto $producto,
    )
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Informar Ganador',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.informar-ganador',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
