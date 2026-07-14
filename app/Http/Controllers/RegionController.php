<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Centre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RegionController extends Controller
{
    /**
     * Afficher la liste des régions
     */
    public function index()
    {
        $regions = Region::withCount('centres')->get();
        $monCentre = Centre::where('matricule', auth()->user()->matricule)->first();
        $isAdmin = $monCentre && $monCentre->type_consultation === 'ADMIN';
        return view('regions.index', compact('regions', 'isAdmin'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        return view('regions.create');
    }

    /**
     * Enregistrer une nouvelle région (avec validation et logs)
     */
   public function store(Request $request)
{
    $request->validate([
        'libelle_region' => 'required|string|max:60|unique:regions,libelle_region',
        'abreviation' => 'required|string|max:5|unique:regions,abreviation'
    ]);

    Region::create([
        'libelle_region' => ucfirst(strtolower(trim($request->libelle_region))),
        'abreviation' => strtoupper(trim($request->abreviation))
    ]);

    return redirect()->route('regions.index')
        ->with('success', '✅ Région créée avec succès !');
}

    /**
     * Afficher les détails d'une région
     */
    public function show($id)
    {
        $region = Region::with(['centres.utilisateur'])->findOrFail($id);
        return view('regions.show', compact('region'));
    }

    /**
     * Afficher le formulaire de modification
     */
    public function edit($id)
    {
        $region = Region::findOrFail($id);
        return view('regions.edit', compact('region'));
    }

    /**
     * Mettre à jour une région (avec validation et logs)
     */
    public function update(Request $request, $id)
    {
        $region = Region::findOrFail($id);

        // ✅ Validation renforcée
        $request->validate([
            'libelle_region' => [
                'required',
                'string',
                'max:60',
                'unique:regions,libelle_region,' . $id . ',id_region',
                'regex:/^[a-zA-ZÀ-ÿ\s\-]+$/'
            ],
            'abreviation' => [
                'required',
                'string',
                'max:5',
                'unique:regions,abreviation,' . $id . ',id_region',
                'regex:/^[A-Z]+$/'
            ]
        ]);

        // ✅ Filtrer et nettoyer les données
        $oldName = $region->libelle_region;
        $region->update([
            'libelle_region' => strip_tags(trim($request->libelle_region)),
            'abreviation' => strtoupper(trim($request->abreviation))
        ]);

        // ✅ Log de l'action
        Log::info('Région modifiée', [
            'ancien_nom' => $oldName,
            'nouveau_nom' => $region->libelle_region,
            'user' => auth()->user()->email ?? 'système',
            'user_id' => auth()->user()->id ?? null,
            'ip' => request()->ip()
        ]);

        return redirect()->route('regions.index')
            ->with('success', 'Région "'.$region->libelle_region.'" mise à jour avec succès !');
    }

    /**
     * Supprimer une région (avec vérification et logs)
     */
    public function destroy($id)
    {
        $region = Region::findOrFail($id);
        
        // ✅ Vérifier si la région a des centres avant de supprimer
        if ($region->centres()->count() > 0) {
            Log::warning('Tentative de suppression échouée', [
                'region' => $region->libelle_region,
                'user' => auth()->user()->email ?? 'système',
                'ip' => request()->ip(),
                'motif' => 'La région contient des centres'
            ]);

            return redirect()->route('regions.index')
                ->with('error', '❌ Impossible de supprimer "'.$region->libelle_region.'" car elle contient '.$region->centres()->count().' centre(s) !');
        }

        $regionName = $region->libelle_region;
        $region->delete();

        // ✅ Log de la suppression
        Log::warning('Région supprimée', [
            'region' => $regionName,
            'user' => auth()->user()->email ?? 'système',
            'user_id' => auth()->user()->id ?? null,
            'ip' => request()->ip()
        ]);

        return redirect()->route('regions.index')
            ->with('success', '✅ Région "'.$regionName.'" supprimée avec succès !');
    }
}