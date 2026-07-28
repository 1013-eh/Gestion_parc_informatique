<?php

namespace App\Http\Controllers;

use App\Models\Centre;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;

class CentreController extends Controller
{
    public function index(Request $request)
    {
        $query = Centre::with(['region', 'responsable']);

        if ($request->filled('region')) {
            $query->where('id_region', $request->region);
        }

        if ($request->filled('type')) {
            $query->where('type_consultation', $request->type);
        }

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('code_bureau', 'LIKE', "%{$search}%")
                  ->orWhere('nom_centre', 'LIKE', "%{$search}%")
                  ->orWhere('adresse_ip', 'LIKE', "%{$search}%");
            });
        }

        $centres = $query->orderBy('code_bureau')->paginate(10);
        
        $nbrCentres = Centre::all()->count();

        $regions = Region::orderBy('libelle_region')->get();

        $monCentre = Centre::where('matricule', auth()->user()->matricule)->first();

        $isAdmin = $monCentre && $monCentre->type_consultation === 'ADMIN';

        return view('centres.index', compact('centres', 'regions', 'isAdmin', 'nbrCentres'));
    }

    public function create()
    {
        $regions = Region::orderBy('libelle_region')->get();

        // Uniquement les utilisateurs qui ne sont affectés à aucun centre
        $users = User::whereDoesntHave('centre')
            ->orderBy('nom')
            ->orderBy('prenom')
            ->get();

        return view('centres.create', compact('regions', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code_bureau' => 'required|integer|unique:centres,code_bureau',
            'nom_centre' => 'required|string|max:100',
            'id_region' => 'required|exists:regions,id_region',
            'matricule' => 'required|exists:users,matricule|unique:centres,matricule',
            'adresse_ip' => [
                'required',
                'unique:centres,adresse_ip',
                'regex:/^(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)$/'
            ],
            'type_consultation' => 'required|in:GLOBAL,PAR_CENTRE,ADMIN'
        ], [
            'adresse_ip.regex' => 'L\'adresse IP doit être au format xxx.xxx.xxx (3 blocs de 0 à 255).'
        ]);

        Centre::create([
            'code_bureau' => $request->code_bureau,
            'nom_centre' => $request->nom_centre,
            'id_region' => $request->id_region,
            'matricule' => $request->matricule,
            'adresse_ip' => $request->adresse_ip,
            'type_consultation' => $request->type_consultation,
        ]);

        return redirect()
            ->route('centres.index')
            ->with('success', 'Centre créé avec succès !');
    }

    public function show($id)
    {
        $centre = Centre::with(['region', 'responsable'])->findOrFail($id);

        return view('centres.show', compact('centre'));
    }

    public function edit($id)
    {
        $centre = Centre::findOrFail($id);

        $regions = Region::orderBy('libelle_region')->get();

        // Utilisateurs non affectés + responsable actuel
        $users = User::whereDoesntHave('centre')
            ->orWhere('matricule', $centre->matricule)
            ->orderBy('nom')
            ->orderBy('prenom')
            ->get();

        return view('centres.edit', compact('centre', 'regions', 'users'));
    }

    public function update(Request $request, $id)
    {
        $centre = Centre::findOrFail($id);

        $request->validate([
            'code_bureau' => 'required|integer|unique:centres,code_bureau,' . $id . ',code_bureau',
            'nom_centre' => 'required|string|max:100',
            'id_region' => 'required|exists:regions,id_region',
            'matricule' => 'required|exists:users,matricule|unique:centres,matricule,' . $id . ',code_bureau',
            'adresse_ip' => [
                'required',
                'unique:centres,adresse_ip,' . $id . ',code_bureau',
                'regex:/^(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)$/'
            ],
            'type_consultation' => 'required|in:GLOBAL,PAR_CENTRE,ADMIN'
        ], [
            'adresse_ip.regex' => 'L\'adresse IP doit être au format xxx.xxx.xxx (3 blocs de 0 à 255).'
        ]);

        $centre->update([
            'code_bureau' => $request->code_bureau,
            'nom_centre' => $request->nom_centre,
            'id_region' => $request->id_region,
            'matricule' => $request->matricule,
            'adresse_ip' => $request->adresse_ip,
            'type_consultation' => $request->type_consultation,
        ]);

        return redirect()
            ->route('centres.index')
            ->with('success', 'Centre mis à jour avec succès !');
    }

    public function destroy($id)
    {
        $centre = Centre::findOrFail($id);

        if ($centre->materiels()->count() > 0) {
            return redirect()
                ->route('centres.index')
                ->with('error', '❌ Impossible de supprimer ce centre car il contient du matériel !');
        }

        $centre->delete();

        return redirect()
            ->route('centres.index')
            ->with('success', '✅ Centre supprimé avec succès !');
    }
}