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
            'matricule' => ['required', 'string'],
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
        $user = User::where('matricule', $this->matricule)->first();

        // Utilisateur inexistant
        if (!$user) {
            throw ValidationException::withMessages([
                'matricule' => 'Matricule ou mot de passe incorrect.',
            ]);
        }

        // Vérifier que l'utilisateur est affecté à un centre
        if (!$user->centre) {
            throw ValidationException::withMessages([
                'matricule' => "Votre compte n'est associé à aucun centre. Veuillez contacter l'administrateur.",
            ]);
        }

        // IP check
        $requestIp = $this->ip();
        $lastDot = strrpos($requestIp, '.');
        if ($lastDot !== false) {
            $ipPrefix = substr($requestIp, 0, $lastDot);
            if ($ipPrefix !== $user->centre->adresse_ip) {
                throw ValidationException::withMessages([
                    'matricule' => 'Connexion refusée : vous devez vous connecter depuis le réseau de votre centre.',
                ]);
            }
        } else {
            throw ValidationException::withMessages([
                'matricule' => 'Connexion refusée : vous devez vous connecter depuis le réseau de votre centre.',
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
                            $user->matricule,
                            $nouveauPassword
                        ));

                } catch (\Exception $e) {

                    Log::error(
                        'Erreur lors de l\'envoi du mail : ' .
                        $e->getMessage()
                    );
                }

                throw ValidationException::withMessages([
                    'matricule' => 'Votre compte a été sécurisé après 3 tentatives de connexion incorrectes. Un nouveau mot de passe a été envoyé sur votre adresse e-mail personnelle.',
                ]);
            }

            throw ValidationException::withMessages([
                'matricule' => 'Matricule ou mot de passe incorrect.',
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