<?php

namespace App\Http\Controllers;

use App\Models\Famille;
use App\Models\SousFamille;
use App\Models\Marque;
use App\Models\Modele;
use App\Models\Region;
use App\Models\Centre;
use App\Models\Materiel;
use App\Models\Archive;

class DashboardController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        if (!$user->centre) {
            abort(403, "Votre compte n'est rattaché à aucun centre. Contactez un administrateur.");
        }

        if ($user->canViewAllCentres()) {
            return view('dashboard', $this->globalStats());
        }

        return view('dashboard', $this->centreStats($user->centre->code_bureau));
    }

    private function globalStats()
    {
        $materielsParCentre = Materiel::where('etat', '!=', 'ARCHIVE')
            ->selectRaw('code_bureau, count(*) as total')
            ->groupBy('code_bureau')
            ->with('centre')
            ->get();

        $archivesParCentre = Archive::whereHas('materiel')
            ->with('materiel.centre')
            ->get()
            ->groupBy(fn ($a) => $a->materiel->code_bureau)
            ->map(fn ($group) => [
                'centre' => $group->first()->materiel->centre,
                'total' => $group->count(),
            ]);

        return [
            'isGlobalView'       => true,
            'familles'           => Famille::withCount('sousFamilles')->get(),
            'famillesCount'      => Famille::count(),
            'sousFamillesCount'  => SousFamille::count(),
            'marquesCount'       => Marque::count(),
            'modelesCount'       => Modele::count(),
            'regions'            => Region::all(),
            'regionsCount'       => Region::count(),
            'centres'            => Centre::all(),
            'centresCount'       => Centre::count(),
            'materielsTotal'     => Materiel::where('etat', '!=', 'ARCHIVE')->count(),
            'materielsParCentre' => $materielsParCentre,
            'archivesTotal'      => Archive::count(),
            'archivesParCentre'  => $archivesParCentre,
        ];
    }

    private function centreStats(int $codeBureau)
    {
        $materiels = Materiel::with('modele.marque.sousFamille.famille')
            ->where('code_bureau', $codeBureau)
            ->where('etat', '!=', 'ARCHIVE')
            ->get();

        $familles = $materiels->pluck('modele.marque.sousFamille.famille')->filter()->unique('id_famille');
        $sousFamilles = $materiels->pluck('modele.marque.sousFamille')->filter()->unique('id_sous_famille');
        $marques = $materiels->pluck('modele.marque')->filter()->unique('id_marque');
        $modeles = $materiels->pluck('modele')->filter()->unique('id_modele');

        return [
            'isGlobalView'      => false,
            'familles'          => $familles,
            'sousFamilles'      => $sousFamilles,
            'marques'           => $marques,
            'modeles'           => $modeles,
            'materielsTotal'    => $materiels->count(),
            'archivesTotal'     => Archive::whereHas('materiel', fn ($q) => $q->where('code_bureau', $codeBureau))->count(),
        ];
    }
}