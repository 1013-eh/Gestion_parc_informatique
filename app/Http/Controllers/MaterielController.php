<?php

namespace App\Http\Controllers;

use App\Models\Materiel;
use \App\Models\SousFamille;
use \App\Models\Centre;
<<<<<<< HEAD
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
=======
use \App\Models\Marque;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \App\Models\Famille;

>>>>>>> 1b28a70 (Fix MaterielController and Materiel model for id_marque schema change)

class MaterielController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        $materiels = Materiel::with('sousFamille')
=======
        $materiels = Materiel::with('marque.sousFamille')
>>>>>>> 1b28a70 (Fix MaterielController and Materiel model for id_marque schema change)
            ->where('etat', '!=', 'ARCHIVE')
            ->get();

        return view('materiels/materiels', compact('materiels'));
    }

    public function create()
    {
<<<<<<< HEAD
        $sousFamilles = SousFamille::all();
        $centres = Centre::all();
        return view('materiels.create', compact('sousFamilles', 'centres'));
=======
        $familles = Famille::orderBy('nom_famille')->get();
        $marques = Marque::all();
        $centres = Centre::all();
        return view('materiels.create', compact('familles', 'marques', 'centres'));
>>>>>>> 1b28a70 (Fix MaterielController and Materiel model for id_marque schema change)
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
<<<<<<< HEAD
            'num_serie'       => 'required|string|max:15|unique:materiels,num_serie|regex:/^SN [A-Z0-9]{8}$/',
            'id_sous_famille' => 'required|integer|exists:sous_familles,id_sous_famille',
            'code_bureau'     => 'required|integer|exists:centres,code_bureau',
            'marque'          => 'required|string|max:30',
            'modele'          => 'required|string|max:30',
=======
            'id_marque' => 'required|integer|exists:marques,id_marque',
            'num_serie'       => 'required|string|max:15|unique:materiels,num_serie|regex:/^SN [A-Z0-9]{8}$/',
            'code_bureau'     => 'required|integer|exists:centres,code_bureau',
>>>>>>> 1b28a70 (Fix MaterielController and Materiel model for id_marque schema change)
            'date_affectation'=> 'required|date|before_or_equal:today',
            'etat'            => 'required|in:BON,EN_PANNE,HORS_USAGE', // I removed ,ARCHIVE
        ]);

        DB::transaction(function () use ($validated, &$materiel) {
            // 
<<<<<<< HEAD
            $sousFamille = SousFamille::findOrFail($validated['id_sous_famille']);
=======
            $marque = Marque::findOrFail($validated['id_marque']);
            $sousFamille = $marque->sousFamille;
>>>>>>> 1b28a70 (Fix MaterielController and Materiel model for id_marque schema change)
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
                $validated['num_ordre'] = null; // null since we made num ordre as an integer :|
            }

            $materiel = Materiel::create($validated);
        });

        return redirect()->route('materiels.index')
            ->with('success', 'Matériel ajouté avec succès.');
    }

    public function edit(Materiel $materiel)
    {
<<<<<<< HEAD
        $sousFamilles = SousFamille::all();
        $centres = Centre::all();
        return view('materiels.edit', compact('materiel', 'sousFamilles', 'centres'));
=======
        $marques = Marque::all();
        $centres = Centre::all();
        return view('materiels.edit', compact('materiel', 'marques', 'centres'));
>>>>>>> 1b28a70 (Fix MaterielController and Materiel model for id_marque schema change)
    }

    public function update(Request $request, Materiel $materiel)
    {
        $validated = $request->validate([
<<<<<<< HEAD
            'num_serie'       => 'required|string|max:15|unique:materiels,num_serie,' . $materiel->num_serie . ',num_serie|regex:/^SN [A-Z0-9]+$/',
            'id_sous_famille' => 'required|integer|exists:sous_familles,id_sous_famille',
            'code_bureau'     => 'required|integer|exists:centres,code_bureau',
            'marque'          => 'required|string|max:30',
            'modele'          => 'required|string|max:30',
=======
            'id_marque' => 'required|integer|exists:marques,id_marque',
            'num_serie'       => 'required|string|max:15|unique:materiels,num_serie,' . $materiel->num_serie . ',num_serie|regex:/^SN [A-Z0-9]{8}$/',
            'code_bureau'     => 'required|integer|exists:centres,code_bureau',
>>>>>>> 1b28a70 (Fix MaterielController and Materiel model for id_marque schema change)
            'date_affectation'=> 'required|date|before_or_equal:today',
            'etat'            => 'required|in:BON,EN_PANNE,HORS_USAGE,ARCHIVE',
        ]);

        DB::transaction(function () use ($validated, $materiel) {
<<<<<<< HEAD
            $familleChanged = $materiel->id_sous_famille != $validated['id_sous_famille'];
            $centreChanged = $materiel->code_bureau != $validated['code_bureau'];

            $sousFamille = SousFamille::findOrFail($validated['id_sous_famille']);
            $famille = $sousFamille->famille;
            $isPosteDeTravail = strtolower($famille->nom_famille) === 'poste de travail';

            if ($isPosteDeTravail && ($familleChanged || $centreChanged)) {
=======
            $marqueChanged = $materiel->id_marque != $validated['id_marque'];
            $centreChanged = $materiel->code_bureau != $validated['code_bureau'];

            $marque = Marque::findOrFail($validated['id_marque']);
            $sousFamille = $marque->sousFamille;
            $famille = $sousFamille->famille;
            $isPosteDeTravail = strtolower($famille->nom_famille) === 'poste de travail';

            if ($isPosteDeTravail && ($marqueChanged || $centreChanged)) {
>>>>>>> 1b28a70 (Fix MaterielController and Materiel model for id_marque schema change)
                $centre = Centre::where('code_bureau', $validated['code_bureau'])
                    ->lockForUpdate()
                    ->first();

                $nextOrdre = ($centre->dernier_num_ordre ?? 0) + 1;
                $region = $centre->region;
                $regionAbbr = $region->abreviation;

                $validated['machine'] = sprintf('%s%d-%03d', $regionAbbr, $centre->code_bureau, $nextOrdre);
                $validated['num_ordre'] = $nextOrdre;

                $centre->update(['dernier_num_ordre' => $nextOrdre]);
<<<<<<< HEAD
            } elseif (!$isPosteDeTravail && $familleChanged) {
=======
            } elseif (!$isPosteDeTravail && $marqueChanged) {
>>>>>>> 1b28a70 (Fix MaterielController and Materiel model for id_marque schema change)
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