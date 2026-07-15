<?php

namespace App\Http\Controllers;

use App\Models\Materiel;
use App\Models\Modele;
use App\Models\Centre;
use App\Models\Famille;
use App\Models\SousFamille;
use App\Models\Marque;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MaterielsExport;
use App\Exports\MaterielTemplateExport;
use App\Imports\MaterielsImport;


class MaterielController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $query = Materiel::with('modele.marque.sousFamille')
            ->where('etat', '!=', 'ARCHIVE');

        if (!$user->canViewAllCentres()) {
            $query->where('code_bureau', $user->centre->code_bureau);
        }

        $materiels = $query->get();
        return view('materiels/materiels', compact('materiels'));
    }

    public function create()
    {
        $this->authorize('modify', Materiel::class);
        $familles = Famille::all();
        $centres = Centre::all();
        return view('materiels.create', compact('familles', 'centres'));
    }

    public function store(Request $request)
    {
        $this->authorize('modify', Materiel::class);
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

            $year = now()->format('Y');
            $lastMarche = Materiel::where('num_marche', 'like', "I-{$year}-%")
                ->orderBy('num_marche', 'desc')
                ->first();
            $lastNum = $lastMarche ? (int) substr($lastMarche->num_marche, -3) : 0;
            $validated['num_marche'] = sprintf('I-%s-%03d', $year, $lastNum + 1);

            $lastCab = Materiel::orderBy('cab', 'desc')->first();
            $nextCabNum = $lastCab ? ((int) substr($lastCab->cab, 3)) + 1 : 200001;
            $validated['cab'] = 'BAM' . $nextCabNum;


            if ($isPosteDeTravail) {
                $centre = Centre::findOrFail($validated['code_bureau']);
                $centre = Centre::where('code_bureau', $validated['code_bureau'])
                    ->lockForUpdate()
                    ->first();

                $region = $centre->region;
                $regionAbbr = $region->abreviation;

                $maxOrdre = Materiel::where('code_bureau', $validated['code_bureau'])
                    ->whereNotNull('num_ordre')
                    ->max('num_ordre');
                $nextOrdre = max(($centre->dernier_num_ordre ?? 0), $maxOrdre ?? 0) + 1;

                $validated['machine'] = sprintf('%s%d-%03d', $regionAbbr, $centre->code_bureau, $nextOrdre);
                $validated['num_ordre'] = $nextOrdre;

                while (Materiel::where('machine', $validated['machine'])->exists()) {
                    $nextOrdre++;
                    $validated['machine'] = sprintf('%s%d-%03d', $regionAbbr, $centre->code_bureau, $nextOrdre);
                    $validated['num_ordre'] = $nextOrdre;
                }
                $centre->update(['dernier_num_ordre' => $nextOrdre]);
            } else {
                $validated['machine'] = null;
                $validated['num_ordre'] = null;
            }

            $materiel = Materiel::create($validated);
        });

        return redirect()->route('materiels.index')
            ->with('success', 'Matériel ajouté avec succès.');
    }

    public function edit(Materiel $materiel)
    {
        $this->authorize('modify', $materiel);
        $familles = Famille::all();
        $centres = Centre::all();

        $selectedModele = $materiel->modele;
        $selectedMarque = $selectedModele->marque;
        $selectedSousFamille = $selectedMarque->sousFamille;
        $selectedFamille = $selectedSousFamille->famille;

        return view('materiels.edit', compact(
            'materiel', 'familles', 'centres',
            'selectedModele', 'selectedMarque', 'selectedSousFamille', 'selectedFamille'
        ));
    }

    public function update(Request $request, Materiel $materiel)
    {
        $this->authorize('modify', $materiel);
        $validated = $request->validate([
            'num_serie'       => 'required|string|max:15|unique:materiels,num_serie,' . $materiel->num_serie . ',num_serie|regex:/^SN [A-Z0-9]{8}$/',
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

                $region = $centre->region;
                $regionAbbr = $region->abreviation;

                $maxOrdre = Materiel::where('code_bureau', $validated['code_bureau'])
                    ->whereNotNull('num_ordre')
                    ->max('num_ordre');
                $nextOrdre = max(($centre->dernier_num_ordre ?? 0), $maxOrdre ?? 0) + 1;

                $validated['machine'] = sprintf('%s%d-%03d', $regionAbbr, $centre->code_bureau, $nextOrdre);
                $validated['num_ordre'] = $nextOrdre;

                while (Materiel::where('machine', $validated['machine'])->exists()) {
                    $nextOrdre++;
                    $validated['machine'] = sprintf('%s%d-%03d', $regionAbbr, $centre->code_bureau, $nextOrdre);
                    $validated['num_ordre'] = $nextOrdre;
                }
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

    public function getSousFamilles(Famille $famille)
    {
        return response()->json(
            $famille->sousFamilles()->select('id_sous_famille', 'nom_sous_famille')->get()
        );
    }

    public function getMarques(SousFamille $sousFamille)
    {
        return response()->json(
            $sousFamille->marques()->select('id_marque', 'nom_marque')->get()
        );
    }

    public function getModeles(Marque $marque)
    {
        return response()->json(
            $marque->modeles()->select('id_modele', 'nom_modele')->get()
        );
    }

    public function export()
    {
        return Excel::download(new MaterielsExport(auth()->user()), 'materiels.xlsx');
    }

    public function downloadTemplate()
    {
        return Excel::download(new MaterielTemplateExport, 'template_materiels.xlsx');
    }

    public function showImportForm()
    {
        return view('materiels.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv',
        ]);

        $import = new MaterielsImport;

        try {
            Excel::import($import, $request->file('file'));
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with('error', 'Erreur base de données : doublon ou contrainte violée. Vérifiez que les numéros de série sont uniques.');
        } catch (\Throwable $e) {
            return back()->with('error', $e->getMessage());
        }

        $successCount = $import->getSuccessCount();
        $validationErrors = $import->getValidationErrors();
        $dbErrors = $import->errors()->map(fn($e) => $e->getMessage())->toArray();
        $allErrors = array_merge($validationErrors, $dbErrors);

        if (empty($allErrors)) {
            return redirect()->route('materiels.index')
                ->with('success', "Importation réussie : {$successCount} matériel(s) importé(s).");
        }

        $errorMessages = collect($allErrors)->map(fn($msg) => "• {$msg}")->implode('<br>');

        if ($successCount > 0) {
            return redirect()->route('materiels.index')
                ->with('success', "{$successCount} matériel(s) importé(s).")
                ->with('warning', count($allErrors) . " ligne(s) ignorée(s) :<br>{$errorMessages}");
        }

        return back()->with('error', "Aucun matériel importé. Erreurs :<br>{$errorMessages}");
    }
}