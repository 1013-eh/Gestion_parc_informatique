<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function show()
    {
        return view('auth.change-password');
    }

    public function update(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::where('matricule', Auth::user()->matricule)->first();
        $user->update([
            'password' => Hash::make($request->password),
            'first_login' => false,
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Mot de passe modifié avec succès.');
    }
}
