<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPasswordNotification extends ResetPassword
{
    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {
        parent::__construct($token);
    }

    /**
     * Build the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->email,
        ], false));

        return (new MailMessage)
            ->subject('Réinitialisation de votre mot de passe')
            ->greeting('Bonjour ' . $notifiable->prenom . ',')
            ->line('Une demande de réinitialisation de votre mot de passe a été effectuée.')
            ->line('Cliquez sur le bouton ci-dessous pour choisir un nouveau mot de passe.')
            ->action('Réinitialiser mon mot de passe', $url)
            ->line('Si vous n\'êtes pas à l\'origine de cette demande, aucune action n\'est requise.');
    }
}