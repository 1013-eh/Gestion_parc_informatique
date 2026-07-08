<?php

namespace App\Http\Controllers;

use App\Models\Materiel;
use \App\Models\SousFamille;
use \App\Models\Centre;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MaterielController extends Controller
{
    public function index()
    {
        $materiels = Materiel::all();
        $materiels = Materiel::with('sousFamille')->get();
        return view('materiels/materiels', compact('materiels'));
    }

    public function create()
    {
        $sousFamilles = SousFamille::all();
        $centres = Centre::all();
        return view('materiels.create', compact('sousFamilles', 'centres'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'num_serie'       => 'required|string|max:15|unique:materiels,num_serie',
            'id_sous_famille' => 'required|integer|exists:sous_familles,id_sous_famille',
            'code_bureau'     => 'required|integer|exists:centres,code_bureau',
            'marque'          => 'required|string|max:30',
            'modele'          => 'required|string|max:30',
            'date_affectation'=> 'required|date',
            'etat'            => 'required|in:BON,EN_PANNE,HORS_USAGE,ARCHIVE',
        ]);

        DB::transaction(function () use ($validated, &$materiel) {
            // 
            $sousFamille = SousFamille::findOrFail($validated['id_sous_famille']);
            $famille = $sousFamille->famille;
            $isPosteDeTravail = strtolower($famille->nom_famille) === 'poste de travail';

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
                $validated['num_ordre'] = 'RAS';
            }

            $materiel = Materiel::create($validated);
        });

        return redirect()->route('materiels.index')
            ->with('success', 'Matériel ajouté avec succès.');
    }
}