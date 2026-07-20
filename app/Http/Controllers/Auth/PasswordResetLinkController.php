<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'matricule' => ['required', 'string', 'exists:users,matricule'],
        ]);

        // Vérifie que l'utilisateur existe
        $user = User::where('matricule', $request->matricule)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'matricule' => ['Aucun utilisateur n\'est associé à ce matricule.'],
            ]);
        }

        // Génère le lien de réinitialisation (envoyé automatiquement
        // à email_perso via getEmailForPasswordReset() sur le modèle User)
        $status = Password::sendResetLink([
            'matricule' => $user->matricule,
        ]);

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', 'Le lien de réinitialisation a été envoyé à votre adresse e-mail personnelle.')
            : back()->withInput($request->only('matricule'))
                ->withErrors([
                    'matricule' => __($status),
                ]);
    }
}