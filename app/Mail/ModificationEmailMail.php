<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class ModificationEmailMail extends Mailable
{
    public $user;
    public $ancienEmail;
    public $nouvelEmail;

    public function __construct(User $user, $ancienEmail, $nouvelEmail)
    {
        $this->user = $user;
        $this->ancienEmail = $ancienEmail;
        $this->nouvelEmail = $nouvelEmail;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Modification de votre compte'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.modification-email'
        );
    }
}