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
            'email' => ['required', 'email'],
        ]);

        // Vérifie que l'utilisateur existe
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['Aucun utilisateur n\'est associé à cette adresse e-mail.'],
            ]);
        }

        // Génère le lien de réinitialisation
        $status = Password::sendResetLink([
            'email' => $user->email,
        ]);

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', 'Le lien de réinitialisation a été envoyé à votre adresse e-mail personnelle.')
            : back()->withInput($request->only('email'))
                ->withErrors([
                    'email' => __($status),
                ]);
    }
}