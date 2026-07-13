<?php

namespace App\Http\Controllers;

use App\Models\Famille;
use App\Models\SousFamille;
use Illuminate\Http\Request;

class SousFamilleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sousFamilles = SousFamille::with('famille')->get();
        return view('admin.sous_familles.index', compact('sousFamilles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $familles = Famille::all();
        return view('admin.sous_familles.create', compact('familles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom_sous_famille' => 'required|unique:sous_familles|max:60',
            'id_famille' => 'required|exists:familles,id_famille',
        ]);

        SousFamille::create([
            'nom_sous_famille' => $request->nom_sous_famille,
            'id_famille' => $request->id_famille,
        ]);

        return redirect()->route('admin.sous_familles.index')->with('success', 'Sous famille cree avec succes.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('admin.sous_familles.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sousFamille = SousFamille::findOrFail($id);
        $familles = Famille::all();
        return view('admin.sous_familles.edit', compact('sousFamille', 'familles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nom_sous_famille' => 'required|unique:sous_familles|max:60',
            'id_famille' => 'required|exists:familles,id_famille',
        ]);

        $sousfamille = SousFamille::findOrFail($id);

        $sousfamille->update([
            'nom_sous_famille' => $request->nom_sous_famille,
            'id_famille' => $request->id_famille,
        ]);

        return redirect()->route('admin.sous_familles.index')->with('success', 'Sous famille modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sousFamille = SousFamille::findOrFail($id);

        if ($sousFamille->marques()->exists()) {
            return back()->with('error', 'Impossible de supprimer cette sous-famille car elle contient des marques.');
        }

        $sousFamille->delete();

        return redirect()->route('admin.sous_familles.index')->with('success', 'Sous-famille supprimée avec succès.');
    }
}
