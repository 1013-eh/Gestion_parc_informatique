<?php

namespace App\Http\Controllers;

use App\Models\Marque;
use App\Models\Modele;
use App\Models\Famille;
use App\Models\SousFamille;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class ModeleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modeles = Modele::with('marque')->get();
        return view('admin.modeles.index', compact('modeles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $familles = Famille::all();
        return view('admin.modeles.create', compact('familles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom_modele' => 'required|unique:modeles|max:50',
            'id_marque' => 'required|exists:marques,id_marque',
        ]);

        Modele::create([
            'nom_modele' => $request->nom_modele,
            'id_marque' => $request->id_marque,
        ]);

        return redirect()->route('admin.familles.index')->with('success', 'Modele cree avec succes.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $modele = Modele::findOrFail($id);
        return view('admin.modeles.show', compact('modele'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $modele = Modele::with('marque.sousFamille')->findOrFail($id);

        $familles = Famille::all();

        $sousFamilles = SousFamille::where(
            'id_famille',
            $modele->marque->sousFamille->id_famille
        )->get();

        $marques = Marque::where(
            'id_sous_famille',
            $modele->marque->id_sous_famille
        )->get();

        return view('admin.modeles.edit', compact(
            'modele',
            'familles',
            'sousFamilles',
            'marques'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $modele = Modele::findOrFail($id);

        $request->validate([
            'nom_modele' => [
                'required',
                'max:50',
                Rule::unique('modeles', 'nom_modele')
                    ->ignore($modele->id_modele, 'id_modele'),
            ],
            'id_marque' => 'required|exists:marques,id_marque',
        ]);

        $modele->update([
            'nom_modele' => $request->nom_modele,
            'id_marque' => $request->id_marque,
        ]);

        return redirect()
            ->route('admin.familles.index')
            ->with('success', 'Modèle modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
