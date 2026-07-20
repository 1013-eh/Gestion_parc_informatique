<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Materiel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class ArchiveController extends Controller
{
    // AFFICHER (tous)
    public function index(){
        try {
            $user = auth()->user();
            $query = Archive::query();

            if (!$user->canViewAllCentres()) {
                $query->whereHas('materiel', function ($q) use ($user) {
                    $q->where('code_bureau', $user->centre->code_bureau);
                });
            }

            $archives = $query->get();
            return view('archive.index', compact('archives'));
        } catch (QueryException $e) {
            Log::error('Erreur lors de la récupération des archives: ' . $e->getMessage());
            return back()->with('error', "Impossible de charger les archives. Veuillez réessayer.");
        }
}

    // formulaire d'ajout
    public function create(Request $request)
    {
        $this->authorize('modify', Archive::class);
        $search = $request->input('search');
        $materiels = Materiel::with('modele.marque')
            ->where('etat', 'HORS_USAGE')
            ->when($search, function ($query, $search) {
                $query->where('num_serie', 'like', "%{$search}%");
            })
            ->orderBy('num_serie')
            ->get();

        return view('archive.create', compact('materiels', 'search'));
    }

    public function createForm($num_serie)
    {
        $this->authorize('modify', Archive::class);
        $materiel = Materiel::with('modele.marque')
            ->where('num_serie', $num_serie)
            ->where('etat', 'HORS_USAGE')
            ->firstOrFail();
        return view('archive.createForm', compact('materiel'));
    }
    // AJOUTER
    public function store(Request $request)
    {
        $this->authorize('modify', Archive::class);
        $validated = $request->validate([
            'num_serie' => [
                'required',
                'string',
                'regex:/^SN [A-Z0-9]{8,}$/',
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
            DB::transaction(function () use ($validated) {
                Archive::create($validated);

                // Le matériel archivé ne doit plus être HORS_USAGE,
                // sinon il pourrait être archivé une seconde fois.
                Materiel::where('num_serie', $validated['num_serie'])
                    ->update(['etat' => 'ARCHIVE']);
            });

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
        $this->authorize('modify', Archive::class);

        $materiel = Materiel::with('modele.marque')->find($archive->num_serie);

        return view('archive.edit', compact('archive', 'materiel'));
    }

    // MODIFIER
    public function update(Request $request, $id)
    {
        $archive = Archive::find($id);

        if (!$archive) {
            return redirect()->route('archive.index')->with('error', "Archive introuvable.");
        }

        $this->authorize('modify', Archive::class);

        $validated = $request->validate([
            'num_serie' => [
                'required',
                'string',
                'regex:/^SN [A-Z0-9]{8,}$/',
                function ($attribute, $value, $fail) {
                    // Ici on modifie une archive existante : le matériel lié
                    // est normalement déjà à l'état ARCHIVE, donc on vérifie
                    // seulement qu'il existe (pas d'exigence HORS_USAGE).
                    if (!Materiel::find($value)) {
                        $fail("Ce numéro de série n'existe pas dans la table matériel.");
                    }
                },
            ],
            'description' => 'required|string|max:200',
            'etat' => 'required|string',
        ]);

        $validated['etat'] = strtoupper(preg_replace('/\s+/', '_', trim($validated['etat'])));
        if (!in_array($validated['etat'], ['BON', 'EN_PANNE', 'HORS_USAGE', 'ARCHIVE'])) {
            return back()->withInput()->with('error', "État '{$validated['etat']}' invalide. Valeurs possibles : BON, EN_PANNE, HORS_USAGE, ARCHIVE.");
        }

        try {
            DB::transaction(function () use ($archive, $validated) {
                $materiel = Materiel::find($validated['num_serie']);
                if ($materiel) {
                    $materiel->etat = $validated['etat'];
                    $materiel->save();
                }

                if ($validated['etat'] === 'ARCHIVE') {
                    // Reste archivé : on met juste à jour les infos de l'archive.
                    $archive->update([
                        'num_serie'   => $validated['num_serie'],
                        'description' => $validated['description'],
                    ]);
                } else {
                    // N'est plus archivé : il retourne dans la table matériels
                    // et disparaît de la liste des archives.
                    $archive->delete();
                }
            });

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
        $this->authorize('modify', Archive::class);
        try {
            $archive->delete();
            return redirect()->route('archive.index')->with('success', 'Archive supprimée avec succès.');
        } catch (QueryException $e) {
            Log::error('Erreur lors de la suppression: ' . $e->getMessage());
            return back()->with('error', "Impossible de supprimer cette archive.");
        }
    }
}