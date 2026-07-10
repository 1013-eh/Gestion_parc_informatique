<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\CompteUtilisateurMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $users = User::when($search, function ($query, $search) {
            $query->where('matricule', 'like', "%{$search}%")
                ->orWhere('nom', 'like', "%{$search}%")
                ->orWhere('prenom', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        })->paginate(10);

        return view('users.index', compact('users', 'search'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
    'matricule' => 'required|digits:8|unique:users',
    'nom' => 'required',
    'prenom' => 'required',
    'email_perso' => 'required|email|unique:users',
    'tel' => 'required|digits:10',
    'etat' => 'required|in:ACTIVE,RETRAITE',
]);

       $email = strtolower(
    $request->prenom . '.' . str_replace(' ', '', $request->nom)
) . '@barid.ma';
    $password = Str::random(10);
       User::create([
    'matricule'   => $request->matricule,
    'nom'         => $request->nom,
    'prenom'      => $request->prenom,
    'email'       => $email,                 // Généré automatiquement
    'email_perso' => $request->email_perso,  // Saisi par l'utilisateur
    'password'    => Hash::make($password),
    'tel'         => $request->tel,
    'etat'        => $request->etat,
    'first_login' => true,
]);
Mail::to($email)->send(new CompteUtilisateurMail($email, $password));
        return redirect()->route('users.index')
            ->with('success', 'Utilisateur ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, User $user)
{
    $request->validate([
        'matricule' => 'required|digits:8|unique:users,matricule,' . $user->matricule . ',matricule',
        'nom'       => 'required|string|max:255',
        'prenom'    => 'required|string|max:255',
        'email_perso' => 'required|email|unique:users,email_perso,' . $user->matricule . ',matricule',
        'tel'       => 'required|digits:10',
        'etat'      => 'required|in:ACTIVE,RETRAITE',
    ]);
    $user->update([
        'matricule'   => $request->matricule,
        'nom'         => $request->nom,
        'prenom'      => $request->prenom,
        'email_perso' => $request->email_perso,
        'tel'         => $request->tel,
        'etat'        => $request->etat,
]);
    return redirect()->route('users.index')
        ->with('success', 'Utilisateur modifié avec succès.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
