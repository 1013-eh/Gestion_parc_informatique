<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CompteBloqueMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $password;

    /**
     * Create a new message instance.
     */
    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Objet du mail.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Réinitialisation de votre mot de passe',
        );
    }

    /**
     * Contenu du mail.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.compte-bloque',
        );
    }

    /**
     * Pièces jointes.
     */
    public function attachments(): array
    {
        return [];
    }
}