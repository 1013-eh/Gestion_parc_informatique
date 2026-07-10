<?php

namespace App\Http\Controllers;

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

        $user = Auth::user();

        $user->password = Hash::make($request->password);
        $user->first_login = false;
        $user->save();

        return redirect()->route('dashboard')
            ->with('success', 'Mot de passe modifié avec succès.');
    }
}