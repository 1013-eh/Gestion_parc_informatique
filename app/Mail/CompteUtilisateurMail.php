<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CompteUtilisateurMail extends Mailable
{
    use Queueable, SerializesModels;

    public $matricule;
    public $password;

    /**
     * Create a new message instance.
     */
    public function __construct($matricule, $password)
    {
        $this->matricule = $matricule;
        $this->password = $password;
    }

    /**
     * Objet du mail.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Création de votre compte',
        );
    }

    /**
     * Vue utilisée pour le contenu du mail.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.compte',
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