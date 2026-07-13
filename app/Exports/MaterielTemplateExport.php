<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MaterielTemplateExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        return [
            [
                'SN AAAAAAAA',
                'Poste de Travail',
                'Ordinateur Portable',
                'Dell',
                'Latitude 3000',
                96518,
                '2026-07-01',
                'BON',
            ],
        ];
    }

    public function headings(): array
    {
        return [
            'num_serie',
            'famille',
            'sous_famille',
            'marque',
            'modele',
            'code_bureau',
            'date_affectation',
            'etat',
        ];
    }
}
