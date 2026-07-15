<?php

namespace Database\Seeders;

use App\Models\Centre;
use Illuminate\Database\Seeder;

class CentreSeeder extends Seeder
{
    public function run(): void
    {
        Centre::create([
            'code_bureau' => 96518,
            'nom_centre' => 'Temara Centre',
            'id_region' => 1,
            'matricule' => 1,
            'adresse_ip' => '127.0.0',
            'dernier_num_ordre' => 0,
            'type_consultation' => 'ADMIN',
        ]);

        Centre::create([
            'code_bureau' => 96519,
            'nom_centre' => 'Casablanca Centre',
            'id_region' => 2,
            'matricule' => 2,
            'adresse_ip' => '127.0.1',
            'dernier_num_ordre' => 0,
            'type_consultation' => 'PAR_CENTRE',
        ]);

        Centre::create([
            'code_bureau' => 96520,
            'nom_centre' => 'Rabat Agdal',
            'id_region' => 3,
            'matricule' => 3,
            'adresse_ip' => '172.27.17',
            'dernier_num_ordre' => 0,
            'type_consultation' => 'GLOBAL',
        ]);
    }
}
