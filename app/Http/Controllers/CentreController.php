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
            $query->where(function($q) use ($search) {
                $q->where('code_bureau', 'LIKE', "%$search%")
                ->orWhere('entete', 'LIKE', "%$search%")
                ->orWhere('adresse_ip', 'LIKE', "%$search%");
            });
        }
        
        // ✅ Récupère les centres
        $centres = $query->orderBy('code_bureau')->paginate(10);
        
        // ✅ Récupère les régions pour le filtre
        $regions = Region::all();
        
        // ✅ Passe les variables à la vue
        return view('centres.index', compact('centres', 'regions'));
    }

    public function create()
    {
        $regions = Region::all();
        $users = User::all();
        return view('centres.create', compact('regions', 'users'));
    }

    public function store(Request $request)
{
    $request->validate([
        'code_bureau' => 'required|integer|unique:centres,code_bureau',
     
        'nom_centre' => 'required|string|max:100',
        'id_region' => 'required|exists:regions,id_region',
        'matricule' => 'required|exists:users,matricule|unique:centres,matricule',
        'adresse_ip' => 'required|ip|unique:centres,adresse_ip',
        'type_consultation' => 'required|in:GLOBAL,PAR_CENTRE,ADMIN'
    ]);

    Centre::create([
        'code_bureau' => $request->code_bureau,
  
        'nom_centre' => $request->nom_centre,
        'id_region' => $request->id_region,
        'matricule' => $request->matricule,
        'adresse_ip' => $request->adresse_ip,
        'type_consultation' => $request->type_consultation
    ]);

    return redirect()->route('centres.index')
        ->with('success', '✅ Centre créé avec succès !');
}

    public function show($id)
    {
$centre = Centre::with(['region', 'responsable'])->findOrFail($id);
        return view('centres.show', compact('centre'));
    }

    public function edit($id)
    {
        $centre = Centre::findOrFail($id);
        $regions = Region::all();
        $users = User::all();
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
        'adresse_ip' => 'required|ip|unique:centres,adresse_ip,' . $id . ',code_bureau',
        'type_consultation' => 'required|in:GLOBAL,PAR_CENTRE,ADMIN'
    ]);

    $centre->update([
        'code_bureau' => $request->code_bureau,
        'nom_centre' => $request->nom_centre,
        'id_region' => $request->id_region,
        'matricule' => $request->matricule,
        'adresse_ip' => $request->adresse_ip,
        'type_consultation' => $request->type_consultation
    ]);

    return redirect()->route('centres.index')
        ->with('success', '✅ Centre mis à jour avec succès !');
}

    public function destroy($id)
    {
        $centre = Centre::findOrFail($id);
        
        if ($centre->materiels()->count() > 0) {
            return redirect()->route('centres.index')
                ->with('error', '❌ Impossible de supprimer ce centre car il contient du matériel !');
        }

        $centre->delete();

        return redirect()->route('centres.index')
            ->with('success', '✅ Centre supprimé avec succès !');
    }
}