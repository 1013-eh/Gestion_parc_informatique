<?php

namespace App\Http\Requests\Auth;

use App\Mail\CompteBloqueMail;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws ValidationException
     */
    public function authenticate(): void
    {
        $user = User::where('email', $this->email)->first();

        // Utilisateur inexistant
        if (!$user) {
            throw ValidationException::withMessages([
                'email' => 'Adresse e-mail ou mot de passe incorrect.',
            ]);
        }

        // Vérifier que l'utilisateur est affecté à un centre
        if (!$user->centre) {
            throw ValidationException::withMessages([
                'email' => "Votre compte n'est associé à aucun centre. Veuillez contacter l'administrateur.",
            ]);
        }

        

        // Vérifier le mot de passe
        if (!Hash::check($this->password, $user->password)) {

            // Incrémenter le nombre de tentatives
            $user->increment('failed_attempts');

            // Après 3 tentatives
            if ($user->failed_attempts == 3) {

                // Générer un nouveau mot de passe
                $nouveauPassword = Str::random(10);

                // Mettre à jour le compte
                $user->update([
                    'password' => Hash::make($nouveauPassword),
                    'failed_attempts' => 0,
                    'first_login' => true,
                ]);

                // Envoyer le nouveau mot de passe
                try {

                    Mail::to($user->email_perso)
                        ->send(new CompteBloqueMail(
                            $user->email,
                            $nouveauPassword
                        ));

                } catch (\Exception $e) {

                    Log::error(
                        'Erreur lors de l\'envoi du mail : ' .
                        $e->getMessage()
                    );
                }

                throw ValidationException::withMessages([
                    'email' => 'Votre compte a été sécurisé après 3 tentatives de connexion incorrectes. Un nouveau mot de passe a été envoyé sur votre adresse e-mail personnelle.',
                ]);
            }

            throw ValidationException::withMessages([
                'email' => 'Adresse e-mail ou mot de passe incorrect.',
            ]);
        }

        // Connexion
        Auth::login($user, $this->boolean('remember'));

        // Régénérer la session
        $this->session()->regenerate();

        // Remettre le compteur à zéro
        $user->update([
            'failed_attempts' => 0,
        ]);
    }
}