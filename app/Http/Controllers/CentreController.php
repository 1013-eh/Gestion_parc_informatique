<?php

namespace App\Http\Controllers;

use App\Models\Centre;
use App\Models\Region;
use App\Models\User;
use App\Models\HistoriqueResponsable;
use Illuminate\Http\Request;

class CentreController extends Controller
{
    public function index(Request $request)
    {
        $query = Centre::with(['region', 'responsable', 'Date_coupure']);

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

        // Uniquement les utilisateurs qui ne sont affectés à aucun centre -- changed
        $users = User::with('centre')->orderBy('matricule')->get();

        return view('centres.create', compact('regions', 'users'));
    }

    public function checkIp(Request $request)
    {
        $exists = Centre::where('adresse_ip', $request->adresse_ip)->exists();

        return response()->json([
            'exists' => $exists
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'code_bureau' => 'required|integer|unique:centres,code_bureau',
            'nom_centre' => 'required|string|max:100',
            'id_region' => 'required|exists:regions,id_region',
            'matricule' => 'required|exists:users,matricule',
            'adresse_ip' => [
                'required',
                'regex:/^(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)$/'
            ],
            'type_consultation' => 'required|in:GLOBAL,PAR_CENTRE,ADMIN',
            'force_create' => 'nullable|boolean'
        ], [
            'adresse_ip.regex' => "L'adresse IP doit être au format xxx.xxx.xxx (3 blocs de 0 à 255)."
        ]);

        // Vérifie si l'adresse IP existe déjà
        $ipExiste = Centre::where('adresse_ip', $request->adresse_ip)->exists();

        // Si elle existe et que l'utilisateur n'a pas encore confirmé
        if ($ipExiste && !$request->boolean('force_create')) {
            return back()
                ->withInput()
                ->with('ip_existante', true);
        }

        // -- changed
        $oldCentre = Centre::where('matricule', $request->matricule)->first();
        if ($oldCentre && !$request->boolean('confirm_change')) {
            $user = User::find($request->matricule);
            return back()
                ->withInput()
                ->with('responsable_create_change', true)
                ->with('warning_message', "{$user->name} est actuellement responsable du centre {$oldCentre->nom_centre}. Il sera transféré vers ce nouveau centre. Confirmer ?");
        }

        if ($oldCentre) {
            $oldCentre->update(['matricule' => null]);
            HistoriqueResponsable::create([
                'code_bureau'       => $oldCentre->code_bureau,
                'ancien_matricule'  => $request->matricule,
                'nouveau_matricule' => null,
            ]);
        }

        Centre::create([
            'code_bureau'        => $request->code_bureau,
            'nom_centre'         => $request->nom_centre,
            'id_region'          => $request->id_region,
            'matricule'          => $request->matricule,
            'adresse_ip'         => $request->adresse_ip,
            'type_consultation'  => $request->type_consultation,
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

        // Utilisateurs non affectés + responsable actuel -- changed
        $users = User::with('centre')->orderBy('matricule')->get();

        return view('centres.edit', compact('centre', 'regions', 'users'));
    }

    public function update(Request $request, $id)
    {
        $centre = Centre::findOrFail($id);

        $request->validate([
            'code_bureau' => 'required|integer|unique:centres,code_bureau,' . $id . ',code_bureau',
            'nom_centre' => 'required|string|max:100',
            'id_region' => 'required|exists:regions,id_region',
            'matricule' => 'required|exists:users,matricule', // -- changed
            'adresse_ip' => [
                'required',
                'regex:/^(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)$/'
            ],
            'type_consultation' => 'required|in:GLOBAL,PAR_CENTRE,ADMIN',
            'force_create' => 'nullable|boolean'
        ], [
            'adresse_ip.regex' => "L'adresse IP doit être au format xxx.xxx.xxx (3 blocs de 0 à 255)."
        ]);

        // Vérifie si un autre centre possède déjà cette IP
        $ipExiste = Centre::where('adresse_ip', $request->adresse_ip)
            ->where('code_bureau', '!=', $centre->code_bureau)
            ->exists();

        // Si l'IP existe déjà et que l'utilisateur n'a pas confirmé
        if ($ipExiste && !$request->boolean('force_create')) {
            return back()
                ->withInput()
                ->with('ip_existante', true);
        }

        // -- changed
        if ($centre->matricule != $request->matricule && $centre->matricule !== null && !$request->boolean('confirm_change') ) {
            $oldUser = User::find($centre->matricule);
            return back()
                ->withInput()
                ->with('responsable_change', true)
                ->with('warning_message', "{$oldUser->name} sera retiré de ce centre et ne pourra plus se connecter jusqu'à ce qu'un nouveau centre lui soit assigné. Confirmer ?");
        }

        if ($centre->matricule != $request->matricule) {
            // -- changed
            $otherCentre = Centre::where('matricule', $request->matricule)
                ->where('code_bureau', '!=', $centre->code_bureau)
                ->first();
            if ($otherCentre) {
                $otherCentre->update(['matricule' => null]);
                HistoriqueResponsable::create([
                    'code_bureau'       => $otherCentre->code_bureau,
                    'ancien_matricule'  => $request->matricule,
                    'nouveau_matricule' => null,
                ]);
            }

            // HistoriqueResponsable::create([
            //     'code_bureau'      => $centre->code_bureau,
            //     'ancien_matricule' => $centre->matricule,
            //     'nouveau_matricule' => $request->matricule,
            // ]);

            // -- changed
            if ($centre->matricule !== null) {
                HistoriqueResponsable::create([
                    'code_bureau'       => $centre->code_bureau,
                    'ancien_matricule'  => $centre->matricule,
                    'nouveau_matricule' => $request->matricule,
                ]);
            }
        }

        $centre->update([
            'code_bureau'       => $request->code_bureau,
            'nom_centre'        => $request->nom_centre,
            'id_region'         => $request->id_region,
            'matricule'         => $request->matricule,
            'adresse_ip'        => $request->adresse_ip,
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
