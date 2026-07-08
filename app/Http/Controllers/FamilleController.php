<?php

namespace App\Http\Controllers;

use App\Models\Famille;
use Illuminate\Http\Request;

class FamilleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $familles = Famille::with('sousFamilles')->get();
        return view('admin.familles.index', compact('familles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.familles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom_famille' => 'required|unique:familles|max:60',
        ]);

        Famille::create([
            'nom_famille' => $request->nom_famille,
        ]);

        return redirect()->route('admin.familles.index')->with('success', 'Famille cree avec succes.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $famille = Famille::findOrFail($id);
        return view('admin.familles.show', compact('famille'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $famille = Famille::findOrFail($id);
        return view('admin.familles.edit', compact('famille'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nom_famille' => 'required|max:60',
        ]);

        $famille = Famille::findOrFail($id);

        $famille->update([
            'nom_famille' => $request->nom_famille,
        ]);

        return redirect()->route('admin.familles.index')->with('success', 'Famille modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
