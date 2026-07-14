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

        $categories = [
            'famillesCount'      => Famille::count(),
            'sousFamillesCount'  => SousFamille::count(),
            'marquesCount'       => Marque::count(),
            'modelesCount'       => Modele::count(),
        ];

        if ($user->canViewAllCentres()) {
            return view('dashboard', array_merge($categories, $this->globalStats()));
        }

        return view('dashboard', array_merge($categories, $this->centreStats($user->centre->code_bureau)));
    }

    private function globalStats()
    {
        $materielsParCentre = Materiel::where('etat', '!=', 'ARCHIVE')
            ->selectRaw('code_bureau, count(*) as total')
            ->groupBy('code_bureau')
            ->with('centre')
            ->get();

        return [
            'isGlobalView'       => true,
            'regions'            => Region::all(),
            'regionsCount'       => Region::count(),
            'centres'            => Centre::all(),
            'centresCount'       => Centre::count(),
            'materielsTotal'     => Materiel::where('etat', '!=', 'ARCHIVE')->count(),
            'materielsParCentre' => $materielsParCentre,
            'archivesTotal'      => Archive::count(),
        ];
    }

    private function centreStats(int $codeBureau)
    {
        return [
            'isGlobalView'      => false,
            'materielsTotal'    => Materiel::where('code_bureau', $codeBureau)->where('etat', '!=', 'ARCHIVE')->count(),
            'archivesTotal'     => Archive::whereHas('materiel', fn ($q) => $q->where('code_bureau', $codeBureau))->count(),
        ];
    }
}