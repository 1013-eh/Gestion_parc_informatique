<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Materiel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class ArchiveController extends Controller
{
    // AFFICHER (tous)
    public function index()
    {
        try {
            $archives = Archive::all();
            return view('archive.index', compact('archives'));
        } catch (QueryException $e) {
            Log::error('Erreur lors de la récupération des archives: ' . $e->getMessage());
            return back()->with('error', "Impossible de charger les archives. Veuillez réessayer.");
        }
    }

    // formulaire d'ajout
    public function create()
    {
        return view('archive.create');
    }

    // AJOUTER
    public function store(Request $request)
    {
        $validated = $request->validate([
            'num_serie' => [
                'required',
                'string',
                'regex:/^SN\d{8}$/',
                function ($attribute, $value, $fail) {
                    $materiel = Materiel::find($value);

                    if (!$materiel) {
                        $fail("Ce numéro de série n'existe pas dans la table matériel.");
                    } elseif ($materiel->etat !== 'HORS_USAGE') {
                        $fail("Ce matériel doit avoir le statut HORS_USAGE pour être archivé. Statut actuel : {$materiel->etat}.");
                    }
                },
            ],
            'description' => 'required|string|max:200',
        ]);

        // Date d'archivage automatique
        $validated['date_archivage'] = now()->toDateString();

        try {
            Archive::create($validated);
            return redirect()->route('archive.index')->with('success', 'Archive ajoutée avec succès.');
        } catch (QueryException $e) {
            Log::error('Erreur lors de l\'ajout d\'une archive: ' . $e->getMessage());
            return back()->withInput()->with('error', "Erreur lors de l'ajout.");
        }
    }

    // AFFICHER (un seul)
    public function show($id)
    {
        $archive = Archive::find($id);

        if (!$archive) {
            return redirect()->route('archive.index')->with('error', "Archive introuvable.");
        }

        return view('archive.show', compact('archive'));
    }

    // formulaire de modification
    public function edit($id)
    {
        $archive = Archive::find($id);

        if (!$archive) {
            return redirect()->route('archive.index')->with('error', "Archive introuvable.");
        }

        return view('archive.edit', compact('archive'));
    }

    // MODIFIER
    public function update(Request $request, $id)
    {
        $archive = Archive::find($id);

        if (!$archive) {
            return redirect()->route('archive.index')->with('error', "Archive introuvable.");
        }

        $validated = $request->validate([
            'num_serie' => [
                'required',
                'string',
                'regex:/^SN\d{8}$/',
                function ($attribute, $value, $fail) {
                    $materiel = Materiel::find($value);

                    if (!$materiel) {
                        $fail("Ce numéro de série n'existe pas dans la table matériel.");
                    } elseif ($materiel->etat !== 'HORS_USAGE') {
                        $fail("Ce matériel doit avoir le statut HORS_USAGE pour être archivé. Statut actuel : {$materiel->etat}.");
                    }
                },
            ],
            'description' => 'required|string|max:200',
        ]);

        try {
            $archive->update($validated);
            return redirect()->route('archive.index')->with('success', 'Archive modifiée avec succès.');
        } catch (QueryException $e) {
            Log::error('Erreur lors de la modification: ' . $e->getMessage());
            return back()->withInput()->with('error', "Erreur lors de la modification.");
        }
    }

    // SUPPRIMER
    public function destroy($id)
    {
        $archive = Archive::find($id);

        if (!$archive) {
            return redirect()->route('archive.index')->with('error', "Archive introuvable.");
        }

        try {
            $archive->delete();
            return redirect()->route('archive.index')->with('success', 'Archive supprimée avec succès.');
        } catch (QueryException $e) {
            Log::error('Erreur lors de la suppression: ' . $e->getMessage());
            return back()->with('error', "Impossible de supprimer cette archive.");
        }
    }
}