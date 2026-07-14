<?php

namespace App\Http\Controllers;

use App\Models\SousFamille;
use App\Models\Famille;
use App\Models\Marque;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MarqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marques = Marque::with('sousfamille')->get();
        return view('admin.marques.index', compact('marques'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $familles = Famille::all();
        return view('admin.marques.create', compact('familles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom_marque' => 'required|unique:marques|max:50',
            'id_sous_famille' => 'required|exists:sous_familles,id_sous_famille',
        ]);

        Marque::create([
            'nom_marque' => $request->nom_marque,
            'id_sous_famille' => $request->id_sous_famille,
        ]);

        return redirect()->route('admin.familles.index')->with('success', 'Marque cree avec succes.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $marque = Marque::findOrFail($id);
        return view('admin.marques.show', compact('marque'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $marque = Marque::with('sousFamille')->findOrFail($id);

        $familles = Famille::all();

        $sousFamilles = SousFamille::where(
            'id_famille',
            $marque->sousFamille->id_famille
        )->get();

        return view('admin.marques.edit', compact(
            'marque',
            'familles',
            'sousFamilles'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $marque = Marque::findOrFail($id);

        $request->validate([
            'nom_marque' => [
                'required',
                'max:50',
                Rule::unique('marques', 'nom_marque')
                    ->ignore($marque->id_marque, 'id_marque'),
            ],
            'id_sous_famille' => 'required|exists:sous_familles,id_sous_famille',
        ]);

        $marque->update([
            'nom_marque' => $request->nom_marque,
            'id_sous_famille' => $request->id_sous_famille,
        ]);

        return redirect()
            ->route('admin.familles.index')
            ->with('success', 'Marque modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
