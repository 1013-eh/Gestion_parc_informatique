<?php

namespace App\Http\Controllers;

use App\Models\Materiel;
use \App\Models\Modele;
use \App\Models\Centre;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MaterielController extends Controller
{
    public function index()
    {
        $materiels = Materiel::with('modele.marque.sousFamille')
            ->where('etat', '!=', 'ARCHIVE')
            ->get();
        return view('materiels/materiels', compact('materiels'));
    }

    public function create()
    {
        $modeles = Modele::with('marque')->get();
        $centres = Centre::all();
        return view('materiels.create', compact('modeles', 'centres'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'num_serie'       => 'required|string|max:15|unique:materiels,num_serie|regex:/^SN [A-Z0-9]{8}$/',
            'id_modele'       => 'required|integer|exists:modeles,id_modele',
            'code_bureau'     => 'required|integer|exists:centres,code_bureau',
            'date_affectation'=> 'required|date|before_or_equal:today',
            'etat'            => 'required|in:BON,EN_PANNE,HORS_USAGE',
        ]);

        DB::transaction(function () use ($validated, &$materiel) {
            $modele = Modele::with('marque.sousFamille.famille')->findOrFail($validated['id_modele']);
            $isPosteDeTravail = strtolower($modele->marque->sousFamille->famille->nom_famille) === 'poste de travail';

            // 
            $year = now()->format('Y');
            $lastMarche = Materiel::where('num_marche', 'like', "I-{$year}-%")
                ->orderBy('num_marche', 'desc')
                ->first();
            $lastNum = $lastMarche ? (int) substr($lastMarche->num_marche, -3) : 0;
            $validated['num_marche'] = sprintf('I-%s-%03d', $year, $lastNum + 1);

            // 
            $lastCab = Materiel::orderBy('cab', 'desc')->first();
            $nextCabNum = $lastCab ? ((int) substr($lastCab->cab, 3)) + 1 : 200001;
            $validated['cab'] = 'BAM' . $nextCabNum;

            // 
            if ($isPosteDeTravail) {
                $centre = Centre::findOrFail($validated['code_bureau']);

                // 
                $centre = Centre::where('code_bureau', $validated['code_bureau'])
                    ->lockForUpdate()
                    ->first();

                $nextOrdre = ($centre->dernier_num_ordre ?? 0) + 1;
                $region = $centre->region;
                $regionAbbr = $region->abreviation;

                $validated['machine'] = sprintf('%s%d-%03d', $regionAbbr, $centre->code_bureau, $nextOrdre);
                $validated['num_ordre'] = $nextOrdre;

                // 
                $centre->update(['dernier_num_ordre' => $nextOrdre]);
            } else {
                $validated['machine'] = null;
                $validated['num_ordre'] = null; // null since we made num ordre as an integer :|
            }

            $materiel = Materiel::create($validated);
        });

        return redirect()->route('materiels.index')
            ->with('success', 'Matériel ajouté avec succès.');
    }

    public function edit(Materiel $materiel)
    {
        $modeles = Modele::with('marque')->get();
        $centres = Centre::all();
        return view('materiels.edit', compact('materiel', 'modeles', 'centres'));
    }

    public function update(Request $request, Materiel $materiel)
    {
        $validated = $request->validate([
            'num_serie'       => 'required|string|max:15|unique:materiels,num_serie,' . $materiel->num_serie . ',num_serie|regex:/^SN [A-Z0-9]+$/',
            'id_modele'       => 'required|integer|exists:modeles,id_modele',
            'code_bureau'     => 'required|integer|exists:centres,code_bureau',
            'date_affectation'=> 'required|date|before_or_equal:today',
            'etat'            => 'required|in:BON,EN_PANNE,HORS_USAGE,ARCHIVE',
        ]);

        DB::transaction(function () use ($validated, $materiel) {
            $modele = Modele::with('marque.sousFamille.famille')->findOrFail($validated['id_modele']);
            $familleChanged = $materiel->id_modele != $validated['id_modele'];
            $centreChanged = $materiel->code_bureau != $validated['code_bureau'];
            $isPosteDeTravail = strtolower($modele->marque->sousFamille->famille->nom_famille) === 'poste de travail';

            if ($isPosteDeTravail && ($familleChanged || $centreChanged)) {
                $centre = Centre::where('code_bureau', $validated['code_bureau'])
                    ->lockForUpdate()
                    ->first();

                $nextOrdre = ($centre->dernier_num_ordre ?? 0) + 1;
                $region = $centre->region;
                $regionAbbr = $region->abreviation;

                $validated['machine'] = sprintf('%s%d-%03d', $regionAbbr, $centre->code_bureau, $nextOrdre);
                $validated['num_ordre'] = $nextOrdre;

                $centre->update(['dernier_num_ordre' => $nextOrdre]);
            } elseif (!$isPosteDeTravail && $familleChanged) {
                $validated['machine'] = null;
                $validated['num_ordre'] = null;
            } else {
                unset($validated['machine'], $validated['num_ordre']);
            }

            $materiel->update($validated);
        });

        return redirect()->route('materiels.index')
            ->with('success', 'Matériel modifié avec succès.');
    }
}