<?php

namespace App\Exports;

use App\Models\Materiel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MaterielsExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function collection()
    {
        $query = Materiel::with('modele.marque.sousFamille.famille', 'centre.region')
            ->where('etat', '!=', 'ARCHIVE');

        if (!$this->user->canViewAllCentres()) {
            $query->where('code_bureau', $this->user->centre->code_bureau);
        }

        return $query->get();
    }

    public function map($materiel): array
    {
        return [
            $materiel->centre?->region?->libelle_region ?? '',
            $materiel->centre?->nom_centre ?? '',
            $materiel->code_bureau,
            $materiel->modele?->marque?->sousFamille?->famille?->nom_famille ?? '',
            $materiel->modele?->marque?->sousFamille?->nom_sous_famille ?? '',
            $materiel->modele?->marque?->nom_marque ?? '',
            $materiel->modele?->nom_modele ?? '',
            $materiel->num_serie,
            $materiel->cab,
            $materiel->num_marche,
            $materiel->date_affectation,
            $materiel->num_ordre,
            $materiel->machine,
            $materiel->etat,
        ];
    }

    public function headings(): array
    {
        return [
            'Région',
            'Centre',
            'Code Bureau',
            'Famille',
            'Sous-Famille',
            'Marque',
            'Modèle',
            'Numéro de Série',
            'CAB',
            'N° Marché',
            'Date Affectation',
            'N° Ordre',
            'Machine',
            'État',
        ];
    }
}