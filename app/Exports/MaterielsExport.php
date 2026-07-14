<?php

namespace App\Exports;

use App\Models\Materiel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MaterielsExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return Materiel::with('modele.marque.sousFamille.famille', 'centre.region')
            ->where('etat', '!=', 'ARCHIVE')
            ->get();
    }

    public function map($materiel): array
    {
        return [
            $materiel->num_serie,
            $materiel->modele?->marque?->sousFamille?->famille?->nom_famille ?? '',
            $materiel->modele?->marque?->sousFamille?->nom_sous_famille ?? '',
            $materiel->modele?->marque?->nom_marque ?? '',
            $materiel->modele?->nom_modele ?? '',
            $materiel->code_bureau,
            $materiel->centre?->nom_centre ?? '',
            $materiel->centre?->region?->libelle_region ?? '',
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
            'Numéro de Série',
            'Famille',
            'Sous-Famille',
            'Marque',
            'Modèle',
            'Code Bureau',
            'Centre',
            'Région',
            'CAB',
            'N° Marché',
            'Date Affectation',
            'N° Ordre',
            'Machine',
            'État',
        ];
    }
}